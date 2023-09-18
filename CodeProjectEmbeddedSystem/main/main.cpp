#include <stdio.h>
#include "freertos/FreeRTOS.h"
#include "freertos/task.h"
#include "driver/gpio.h"
#include "esp_log.h"
// #include "led_strip.h"
#include "sdkconfig.h"

#include"string.h"
#include <cstring>

#include <iostream>
using namespace std;


static const char *TAG = "main";
#include "Hardware/Hardware.h"

#include "KiemTraInternet.h"
#include "cJSON.h"
#include "POSTGET.h"

extern "C"{
    void app_main(void);
}

char _IMEI[13];
void GetChipID(){
    // Lấy và chuyển đổi số MAC thành kiểu chuỗi
    uint8_t MAC[6];
    // Đọc base MAC add và chuyển nó thành MAC add cho interface -> gán
    esp_read_mac(MAC, ESP_MAC_WIFI_STA);  
    for (uint8_t i = 0; i < 6; i++){
        static int index = 0;
        //snprintf: snprintf (char * s, size_t n, const char * format, ...);
        //thay vì printf là hàm in ra màn hình, thì snprintf sẽ lấy nội dung được truyền vào 
        //lưu vào chuỗi được trỏ tới bởi s
        index += snprintf(&_IMEI[index], 20 - index, "%02X", MAC[i]); //mà tại sao giữa là 20 - index: độ dài còn lại trong bộ đệm
        //nếu index sau vòng for != có nghĩa là chương trình chạy đã lỗi do snprintf trả về -1
        //lỗi khi 1 trong các thông số được truyền vào hàm = NULL:
        //tham số đầu: truyền địa chỉ array IMEI để lưu chuỗi output
        // tham số cuối: truyền từng phần tử trong dãy IMEI để format lại đưa vào array IMEI
        //mà tại sao index tăng 1 sau mỗi lần snprintf

    }
    // Cập nhật SSID cho WiFi AP
    snprintf((char *)wifi_settings.ap_ssid, MAX_SSID_SIZE, "%s_%s", DEFAULT_AP_SSID, _IMEI);
    ESP_LOGI(TAG, "MAC: %s",_IMEI);
}

uint8_t duration;
sht3x_t sht31_dev;
float _NhietDo, _DoAm;

void vTaskDocCamBienSHT31(void *pvParameters){
    memset(&sht31_dev, 0, sizeof(sht3x_t));
    sht3x_init_desc(&sht31_dev, 0, 0x44, I2C_SDA_GPIO, I2C_SCL_GPIO);
    sht3x_init(&sht31_dev);
    duration = sht3x_get_measurement_duration(SHT3X_HIGH);

    while(1){
        sht3x_start_measurement(&sht31_dev, SHT3X_SINGLE_SHOT, SHT3X_HIGH);
        vTaskDelay(duration);
        sht3x_get_results(&sht31_dev, &_NhietDo, &_DoAm);
        ESP_LOGI(TAG, "Cảm biến SHT31: %.2f°C, %.2f%%", _NhietDo, _DoAm);

        vTaskDelay(pdMS_TO_TICKS(1000));
    }
    vTaskDelete(NULL);
}

i2c_dev_t BH1750_Dev;
uint16_t Lux_Data;

void vTaskDocCamBienBH1750(void *pvParameters){
    bh1750_init_desc(&BH1750_Dev, BH1750_ADDR_LOW, 0, I2C_SDA_GPIO, I2C_SCL_GPIO);
    bh1750_setup(&BH1750_Dev, BH1750_MODE_CONTINUOUS, BH1750_RES_HIGH);

    while(1){
        if (bh1750_read(&BH1750_Dev, &Lux_Data) != ESP_OK)
            ESP_LOGE(TAG, "Could not read lux data"); 
        else
            ESP_LOGW(TAG, "Cảm biến BH1750: %dlx", Lux_Data); 
        vTaskDelay(pdMS_TO_TICKS(1000));
    }
    vTaskDelete(NULL);
}


char http_response_post[MAX_HTTP_OUTPUT_BUFFER];
void PostData(){
    char url_request[256];
    snprintf(url_request, 256, 
        "http://nckh.assfa.net/postdata.php?ThietBi=%s&NhietDo=%.2f&DoAm=%.2f&AnhSang=%d&CO2=480&Mua=1&ThoiTiet=1",_IMEI, _NhietDo, _DoAm, Lux_Data);
    cout << url_request << endl;
    HTTP_CODE_e http_code = http_get(url_request, http_response_post);
}

char http_response[MAX_HTTP_OUTPUT_BUFFER];
char http_response_cut[MAX_HTTP_OUTPUT_BUFFER];

int TrangThaiRelay;

void GetData(){
    HTTP_CODE_e http_code = http_get("http://nckh.assfa.net/relay.php", http_response);
    /**/
    cout << http_response << endl;
    TrangThaiRelay = http_response[11] - 48;
    cout << "TrangThaiRelay: " << TrangThaiRelay << endl;
    gpio_set_level(RELAY, TrangThaiRelay);

    // if (http_code == HTTP_OK)
    // {
    //     cJSON *root = cJSON_Parse(http_response);
    //     if (cJSON_GetArraySize(root) > 0)
    //     {
    //         cJSON *json = cJSON_GetArrayItem(root, 0);
    //         if (json != NULL)
    //         {
    //             // Hàm cJSON_Print có cấp phát bộ nhớ để tạo ra chuỗi có format JSON.
    //             // Nên cần phải gán con trỏ vào để sau khi dùng xong, ta phải giải phóng bộ nhớ.
    //             // char *str = cJSON_Print(json);
    //             // ESP_LOGE(TAG, "Mã CODE lấy được: %s", str);
    //             // free(str);
    //             cJSON *jsonRelay = cJSON_GetObjectItemCaseSensitive(json, "Relay1");
    //             //json_item = cJSON_GetObjectItemCaseSensitive(json, "TotalValve");

    //             if (cJSON_IsNumber(jsonRelay) && jsonRelay->valueint){
    //                 TrangThaiRelay = jsonRelay->valueint;
    //                 gpio_set_level(RELAY, TrangThaiRelay);
    //             }
    //             else{
    //                 ESP_LOGE(TAG, "Get error");
    //             }

    //             // cout << jsonCheDoDieuKhien << endl; //cái này id ra đang bị NULL
    //             // if (jsonCheDoDieuKhien != NULL)
    //             // {
    //             //     cout << jsonCheDoDieuKhien << endl;
    //             //     // http_response_cut = jsonCheDoDieuKhien->*valuestring;
    //             // }
    //         }
    //     }
    //     }
}

void app_main(void){
    ESP_ERROR_CHECK(i2cdev_init());
    KhoiTaoIO();

    GetChipID();
    /* start the wifi manager */
	wifi_manager_start();
	wifi_manager_set_callback(WM_EVENT_STA_GOT_IP, &CheckIP);
    

//    xTaskCreatePinnedToCore(vTaskDocCamBienSHT31, "vTaskDocCamBienSHT31", 4096, NULL, 1, NULL, 0);
//    xTaskCreatePinnedToCore(vTaskDocCamBienBH1750, "vTaskDocCamBienBH1750", 4096, NULL, 1, NULL, 0);

    while (1) {
        if(KiemTraInternet() == CONNECTION_INTERNET_OK){
            TatLEDStatus();
            GetData();
        }
        else{
            BatLEDStatus();
        }
        //TrangThaiRelay = 1 - TrangThaiRelay;
        // gpio_set_level(RELAY, 1);
        // vTaskDelay(pdMS_TO_TICKS(1000));
        // gpio_set_level(RELAY, 0);
        vTaskDelay(pdMS_TO_TICKS(100));
        
    }
}
