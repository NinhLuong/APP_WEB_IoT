#include "KiemTraInternet.h"

static const char *TAG = "KiemTraInternet";

static ConnectionStatus_e TrangThaiInternet;

void CheckIP(void *pvParameter){
	ip_event_got_ip_t* param = (ip_event_got_ip_t*)pvParameter;
	char str_ip[16];
	esp_ip4addr_ntoa(&param->ip_info.ip, str_ip, IP4ADDR_STRLEN_MAX);
	ESP_LOGI(TAG, "I have a connection and my IP is %s!", str_ip);
}

ConnectionStatus_e KiemTraInternet(void){
    KiemTraDNS("google.com");
    return TrangThaiInternet;
}

esp_err_t KiemTraDNS(char *host){
    esp_err_t err = ESP_OK;
    if (_CheckWIFIDaKetNoi()){
        // parse IP address
        ip_addr_t target_addr;
        memset(&target_addr, 0, sizeof(target_addr));
        struct addrinfo hint;
        struct addrinfo *res = NULL;
        memset(&hint, 0, sizeof(hint));
        /* convert ip4 string or hostname to ip4 or ip6 address */
        if (getaddrinfo(host, NULL, &hint, &res) != 0){
            ESP_LOGE(TAG, "Mất Internet");
            ESP_LOGD(TAG, "unknown host %s", host);
            TrangThaiInternet = CONNECTION_NO_INTERNET;
            err = ESP_FAIL;
        }
        else{
            ESP_LOGI(TAG, "Internet OK");
            TrangThaiInternet = CONNECTION_INTERNET_OK;
            err = ESP_OK;
        }
        freeaddrinfo(res);
    }
    else{
        TrangThaiInternet = CONNECTION_NO_WIFI;
    }
    return err;
}
