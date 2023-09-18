#include "Hardware.h"
static const char *TAG = "Hardware";

    esp_err_t KhoiTaoIO(void){
    esp_err_t ret = ESP_OK;
    
    ESP_LOGI(TAG, "Khởi tạo Led trạng thái");
    ret |= gpio_reset_pin(LED);
    ret |= gpio_set_direction(LED, GPIO_MODE_OUTPUT);

    ESP_LOGI(TAG, "Khởi tạo button");
    ret |= gpio_reset_pin(BUTTON);
    ret |= gpio_set_direction(BUTTON, GPIO_MODE_INPUT);   

    ESP_LOGI(TAG, "Khởi tạo relay");
    ret |= gpio_reset_pin(RELAY);
    ret |= gpio_set_direction(RELAY, GPIO_MODE_OUTPUT); 
    return ret;
}

esp_err_t BatLEDStatus(void){
    return gpio_set_level(LED, 1);
}

esp_err_t TatLEDStatus(void){
    return gpio_set_level(LED, 0);
}


