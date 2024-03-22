
//uint8_t btn_prev_num[] = {12, 13, 14, 25, 26, 27, 32, 33, 34, 35, 36, 39 };
#include <stdint.h>
#include <Arduino.h>

uint8_t btn_prev_12;
uint8_t btn_prev_13;
uint8_t btn_prev_14;
uint8_t btn_prev_25;
uint8_t btn_prev_26;
uint8_t btn_prev_27;

uint16_t slider_32;
uint16_t slider_33;
uint16_t slider_34;
uint16_t slider_35;
uint16_t slider_36;
uint16_t slider_39;

uint16_t slider_new_32;
uint16_t slider_new_33;
uint16_t slider_new_34;
uint16_t slider_new_35;
uint16_t slider_new_36;
uint16_t slider_new_39;

float limit = 0.9;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  //Serial.println("Hello, ESP32!");
  pinMode(12, INPUT_PULLUP); // config GIOP21 as input pin and enable the internal pull-up resistor
  pinMode(13, INPUT_PULLUP); // config GIOP21 as input pin and enable the internal pull-up resistor
  pinMode(14, INPUT_PULLUP);
  pinMode(25, INPUT_PULLUP);
  pinMode(26, INPUT_PULLUP);
  pinMode(27, INPUT_PULLUP);
  pinMode(32, INPUT_PULLUP);
  pinMode(33, INPUT_PULLUP);
  pinMode(34, INPUT_PULLUP);
  pinMode(35, INPUT_PULLUP);
  pinMode(36, INPUT_PULLUP);
  pinMode(39, INPUT_PULLUP);

  btn_prev_12 = digitalRead(12);
  btn_prev_13 = digitalRead(13);
  btn_prev_14 = digitalRead(14);
  btn_prev_25 = digitalRead(25);
  btn_prev_26 = digitalRead(26);
  btn_prev_27 = digitalRead(27);

  slider_32 = analogRead(32);
  slider_33 = analogRead(33);
  slider_34 = analogRead(34);
  slider_35 = analogRead(35);
  slider_36 = analogRead(36);
  slider_39 = analogRead(39);


  
}

void loop() {
  // put your main code here, to run repeatedly:
  delay(150); // this speeds up the simulation

  if (digitalRead(12) == LOW && btn_prev_12 == HIGH) {
      Serial.println(2);
    }
  btn_prev_12 = digitalRead(12);

  if (digitalRead(13) == LOW && btn_prev_13 == HIGH) {
      Serial.println(1);
    }
  btn_prev_13 = digitalRead(13);

  if (digitalRead(14) == LOW && btn_prev_14 == HIGH) {
      Serial.println(4);
    }
  btn_prev_14 = digitalRead(14);

  if (digitalRead(25) == LOW && btn_prev_25 == HIGH) {
      Serial.println(3);
    }
  btn_prev_25 = digitalRead(25);

  if (digitalRead(26) == LOW && btn_prev_26 == HIGH) {
      Serial.println(6);
    }
  btn_prev_26 = digitalRead(26);

  if (digitalRead(27) == LOW && btn_prev_27 == HIGH) {
      Serial.println(5);
    }
  btn_prev_27 = digitalRead(27);


  slider_new_32 = analogRead(32);
  slider_new_32 = map(slider_new_32, 0, 4095, 0, 100);

  slider_new_33 = analogRead(33);
  slider_new_33 = map(slider_new_33, 0, 4095, 0, 100);

  slider_new_34 = analogRead(34);
  slider_new_34 = map(slider_new_34, 0, 4095, 0, 100);

  slider_new_35 = analogRead(35);
  slider_new_35 = map(slider_new_35, 0, 4095, 0, 100);

  slider_new_36 = analogRead(36);
  slider_new_36 = map(slider_new_36, 0, 4095, 0, 100);

  slider_new_39 = analogRead(39);
  slider_new_39 = map(slider_new_39, 0, 4095, 0, 100);

  if (abs(slider_new_32 - slider_32) > limit){
    slider_32 = analogRead(32);
    int percentage_32 = map(slider_32, 0, 4095, 0, 100);
    Serial.println(5000+percentage_32);
  }

  if (abs(slider_new_33 - slider_33) > limit){
    slider_33 = analogRead(33);
    int percentage_33 = map(slider_33, 0, 4095, 0, 100);
    Serial.println(6000+percentage_33);
  }

  if (abs(slider_new_34 - slider_34) > limit){
    slider_34 = analogRead(34);
    int percentage_34 = map(slider_34, 0, 4095, 0, 100);
    Serial.println(3000+percentage_34);
  }

  if (abs(slider_new_35 - slider_35) > limit){
    slider_35 = analogRead(35);
    int percentage_35 = map(slider_35, 0, 4095, 0, 100);
    Serial.println(4000+percentage_35);
  }

  if (abs(slider_new_36 - slider_36) > limit){
    slider_36 = analogRead(36);
    int percentage_36 = map(slider_36, 0, 4095, 0, 100);
    Serial.println(1000+percentage_36);
  }

  if (abs(slider_new_39 - slider_39) > limit){
    slider_39 = analogRead(39);
    int percentage_39 = map(slider_39, 0, 4095, 0, 100);
    Serial.println(2000+percentage_39);
  }

  slider_32 = analogRead(32);
  slider_32 = map(slider_32, 0, 4095, 0, 100);
  slider_33 = analogRead(33);
  slider_33 = map(slider_33, 0, 4095, 0, 100);
  slider_34 = analogRead(34);
  slider_34 = map(slider_34, 0, 4095, 0, 100);
  slider_35 = analogRead(35);
  slider_35 = map(slider_35, 0, 4095, 0, 100);
  slider_36 = analogRead(36);
  slider_36 = map(slider_36, 0, 4095, 0, 100);
  slider_39 = analogRead(39);
  slider_39 = map(slider_39, 0, 4095, 0, 100);
    
}
