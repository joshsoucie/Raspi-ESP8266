#include <ESP8266WiFi.h>
#include <TimedAction.h>

const char* ssid = "HomeSweetHome";
const char* password = "020293120490";

const char* host = "192.168.31.134";
const char* streamID = "collectdata.php";

const int LED_pin = 5;
const int button_Pin = 4;
int buttonState;
int lastButtonState = LOW;
int lightState = LOW;

unsigned long lastDebounceTime = 0;
unsigned long debounceDelay = 50;


void updateDB() {
  WiFiClient client;

  Serial.print("connecting to ");
  Serial.println(host);

  if (!client.connect(host, 80)) {
    Serial.println("Connection Failed!");
    delay(10);
    return;
  }

  String url = "/php/";
  url += streamID;
  url += "?lightState=";
  url += lightState;

  Serial.print("Requesting URL: ");
  Serial.println(url);

  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
          "Host: " + host + "\r\n" +
          "Connection: close\r\n\r\n");
  delay(10);
  Serial.println("Print to Host Complete");
  Serial.println("Closing Connection");

}

TimedAction timedAction = TimedAction(500, updateDB);

void setup() {
  Serial.begin(115200);
  delay(10);

  // prepare GPIO2
  pinMode(LED_pin, OUTPUT);
  digitalWrite(LED_pin, lightState);
  pinMode(button_Pin, INPUT);

  WiFi.begin(ssid, password);

  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");

}

void loop() {

  int reading = digitalRead(button_Pin);

  if (reading != lastButtonState) {
    lastDebounceTime = millis();
    }

  if ((millis() - lastDebounceTime) < debounceDelay) {
    if (reading != lastButtonState) {
      buttonState = reading;
    }
    if (buttonState == HIGH) {
      lightState = !lightState;
    }
  }

  digitalWrite(LED_pin, lightState);
  lastButtonState = reading;

  timedAction.check();

  delay(10);
  }
