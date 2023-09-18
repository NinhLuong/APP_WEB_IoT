#ifndef __HARDWARE_H__
#define __HARDWARE_H__

#include "esp_log.h"
#include "driver/gpio.h"

#include "driver/mcpwm.h"
#include "soc/mcpwm_periph.h"

#include <i2cdev.h>

#include <sht3x.h>
#include <bh1750.h>

#include <iostream>
using namespace std;

#define BUTTON                          GPIO_NUM_0
#define LED                             GPIO_NUM_23

#define RELAY                           GPIO_NUM_5

#define I2C_SDA_GPIO                    GPIO_NUM_19
#define I2C_SCL_GPIO                    GPIO_NUM_18



esp_err_t KhoiTaoIO(void);

esp_err_t BatLEDStatus(void);
esp_err_t TatLEDStatus(void);

#endif // __HARDWARE_H__