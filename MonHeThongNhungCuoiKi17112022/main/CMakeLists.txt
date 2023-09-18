idf_component_register(
    SRCS "main.cpp"
    SRCS "Hardware/Hardware.cpp"
    INCLUDE_DIRS "."
    REQUIRES    sht3x
                bh1750
                KiemTraInternet
                POSTGET 
                json)
