#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>

// Network SSID
const char* ssid = "LET Lantai 1";
const char* password = "AYOngopi";

// Host
const char* host = "192.168.1.172";

#define LED_PIN 15 // D8
#define BTN_PIN 5 // D1
// menyediakan variabel untuk RFID
#define SDA_PIN 2 // D4
#define RST_PIN 0 // D3

MFRC522 mfrc522(SDA_PIN, RST_PIN);

void setup() {
  // Put your setup code here, to run once:
  Serial.begin(9600);

  // Connect to WiFi
  WiFi.hostname("NodeMCU");
  WiFi.begin(ssid, password);

  // Check connection
  while (WiFi.status() != WL_CONNECTED) {
    // Looking for WiFi
    delay(500);
    Serial.print(".");
  }
  Serial.println("WiFi Connected");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());

  pinMode(LED_PIN, OUTPUT);
  pinMode(BTN_PIN, INPUT_PULLUP); // Changed to INPUT_PULLUP for button input

  SPI.begin();
  mfrc522.PCD_Init();
  Serial.println("Dekatkan Kartu RFID");
  Serial.println();
}

void loop() {
  // Put your main code here, to run repeatedly:
  if (digitalRead(BTN_PIN) == HIGH) { // Changed condition to check button state correctly
    Serial.println("OK");
    // nyalakan LED
    digitalWrite(LED_PIN, HIGH);
    while (digitalRead(BTN_PIN) == HIGH); // menahan proses sampai tombol dilepas
    // ubah mode absensi di aplikasi web
    String Link = "http://192.168.1.172/absensi/ubahmode.php";
    HTTPClient http;
    http.begin(Link);
    int httpCode = http.GET();
    String payload = http.getString();
    Serial.println(payload);
    http.end();
    // matikan LED
    digitalWrite(LED_PIN, LOW);
  }

  if (!mfrc522.PICC_IsNewCardPresent())
    return;
  if (!mfrc522.PICC_ReadCardSerial())
    return;

  String IDTAG = "";
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    IDTAG += mfrc522.uid.uidByte[i];
  }

  // nyalakan LED
  digitalWrite(LED_PIN, HIGH);

  // kirim nomor kartu RFID untuk disimpan ke tabel tmprfid
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("Connection Failed");
    return;
  }

  String Link = "http://192.168.1.172/absensi/kirimkartu.php?nokartu=" + IDTAG; // Fixed missing "="
  HTTPClient http;
  http.begin(Link);
  int httpCode = http.GET();
  String payload = http.getString();
  Serial.println(payload);
  http.end();

  delay(2000);
}
