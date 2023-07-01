//----------------------------------------Include the NodeMCU ESP8266 Library---------------------------------------------------------------------------------------------------------------//
//----------------------------------------see here: https://www.youtube.com/watch?v=8jMr94B8iN0 to add NodeMCU ESP8266 library and board
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//----------------------------------------Include the SPI and MFRC522 libraries-------------------------------------------------------------------------------------------------------------//
//----------------------------------------Download the MFRC522 / RC522 library here: https://github.com/miguelbalboa/rfid
#include <SPI.h>
#include <MFRC522.h>
#include <WiFiClient.h>
#include <LiquidCrystal_I2C.h>
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

#define SS_PIN D4  //--> SDA / SS is connected to pinout D2
#define RST_PIN D3  //--> RST is connected to pinout D1
int lcdColumns = 16;
int lcdRows = 2;

MFRC522 mfrc522(SS_PIN, RST_PIN);  //--> Create MFRC522 instance.
LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows);  
WiFiClient client;

#define ON_Board_LED 2  //--> Defining an On Board LED, used for indicators when the process of connecting to a wifi router
#define trava D0 //a trava
#define Buzzer D8 //o buzzer
//----------------------------------------SSID and Password of your WiFi router-------------------------------------------------------------------------------------------------------------//
const char* ssid = "Wifi Alunos";
const char* password = "";
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

ESP8266WebServer server(80);  //--> Server on port 80

int readsuccess;
byte readcard[4];
char str[32] = "";
String StrUID;

//-----------------------------------------------------------------------------------------------SETUP--------------------------------------------------------------------------------------//
void setup() {
  // initialize LCD
  lcd.init();
  // turn on LCD backlight                      
  lcd.backlight();
  Serial.begin(115200); //--> Initialize serial communications with the PC
  SPI.begin();      //--> Init SPI bus
  mfrc522.PCD_Init(); //--> Init MFRC522 card
  pinMode(trava, OUTPUT);
  pinMode(Buzzer, OUTPUT);
  noTone(Buzzer);
  delay(500);

  WiFi.begin(ssid, password); //--> Connect to your WiFi router
  Serial.println("");
    
  pinMode(ON_Board_LED,OUTPUT); 
  digitalWrite(ON_Board_LED, HIGH); //--> Turn off Led On Board

  //----------------------------------------Wait for connection

  lcd.setCursor(3,0);
  // print message
  lcd.print("CONECTANDO");
  lcd.setCursor(2,1);
  // print message
  lcd.print("NA REDE WIFI!");
  Serial.print("Connecting");
  int tentativas= NULL;
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    //----------------------------------------Make the On Board Flashing LED on the process of connecting to the wifi router.
    digitalWrite(ON_Board_LED, LOW);
    delay(250);
    digitalWrite(ON_Board_LED, HIGH);
    delay(250);
    if(tentativas > 100){
      break;
    }
    tentativas++;
  }
  if(WiFi.status() == WL_CONNECTED){
  lcd.clear();
  lcd.setCursor(3,0);
  // print message
  lcd.print("CONECTADO");
  lcd.setCursor(2,1);
  // print message
  lcd.print("NA REDE WIFI!");
  delay(1500);
  lcd.clear();
    
  
  digitalWrite(ON_Board_LED, HIGH); //--> Turn off the On Board LED when it is connected to the wifi router.
   digitalWrite(trava, LOW);
  //----------------------------------------If successfully connected to the wifi router, the IP Address that will be visited is displayed in the serial monitor
  Serial.println("");
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  Serial.println("Please tag a card or keychain to see the UID !");
  Serial.println("");

  mensagem();
  }else{
    
    lcd.clear();
    lcd.setCursor(6,0);
    // print message
    lcd.print("MODO");
    lcd.setCursor(4,1);
    // print message
    lcd.print("OFFLINE!");
    
  }
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//-----------------------------------------------------------------------------------------------LOOP---------------------------------------------------------------------------------------//
void loop() {
  
  // put your main code here, to run repeatedly
  readsuccess = getid();
  //mensagem(readsuccess);
  if(readsuccess) {  
  digitalWrite(ON_Board_LED, LOW);
   HTTPClient http;    //Declare object of class HTTPClient
   
 
   String UIDresultSend, postData,local;
   UIDresultSend = StrUID;
   local="16875";
   
    //Post Data
    postData = UIDresultSend;
    Serial.println(postData);
    http.begin(client,"http://controlenodemcu.000webhostapp.com/consult.php?tag="+UIDresultSend+"&local="+local);
     //http.begin(client,"http://192.168.43.168/txt2/consult.php?tag="+UIDresultSend+"&local="+local);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header"
    int httpCode = http.POST(postData);   //Send the request
    const String& payload = http.getString();    //Get the response payload       
    Serial.println(httpCode);   //Print HTTP return code
    String recebe=payload;
    int valor=imprimir(recebe);
    control(valor);
    http.end();  //Close connection
    delay(1000);
  digitalWrite(ON_Board_LED, HIGH);
  }
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//----------------------------------------Procedure for reading and obtaining a UID from a card or keychain---------------------------------------------------------------------------------//
int getid() {  
  if(!mfrc522.PICC_IsNewCardPresent()) {
    return 0;
  }
  if(!mfrc522.PICC_ReadCardSerial()) {
    return 0;
  }
 
  Serial.print("THE UID OF THE SCANNED CARD IS : ");
  
  for(int i=0;i<4;i++){
    readcard[i]=mfrc522.uid.uidByte[i]; //storing the UID of the tag in readcard
    array_to_string(readcard, 4, str);
    StrUID = str;
  }
  mfrc522.PICC_HaltA();
  return 1;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//



//----------------------------------------Procedure to change the result of reading an array UID into a string------------------------------------------------------------------------------//
void array_to_string(byte array[], unsigned int len, char buffer[]) {
    for (unsigned int i = 0; i < len; i++)
    {
        byte nib1 = (array[i] >> 4) & 0x0F;
        byte nib2 = (array[i] >> 0) & 0x0F;
        buffer[i*2+0] = nib1  < 0xA ? '0' + nib1  : 'A' + nib1  - 0xA;
        buffer[i*2+1] = nib2  < 0xA ? '0' + nib2  : 'A' + nib2  - 0xA;
    }
    buffer[len*2] = '\0';
}


//--------------------------------Procedimento de impressão-----------------------------//
int imprimir(String payload){

Serial.print("received payload:\n<<");
int i,j=0;
char v[100];
        
for(i=0;i<payload.length();i++){
       
if(payload[i] >=65 && payload[i]<=90 || payload[i] >=97 && payload[i]<=122 || payload[i]==32 ){
   v[j]=payload[i];
   j++;
     }
        }
 v[j]='\0';
char  recebe[j];
int cont = 0;       
for(i=0;i<j;i++){

recebe[i]=v[i]; 
cont = cont + 1;       
    }
 recebe[j]='\0';
       
Serial.printf("%s",recebe);
//Serial.printf("%d",cont);
Serial.println(">>");
return cont;
        
}

//--------------------------------------------------------------------------------------//

void control(int valor){
int principal = 8;

if(principal == valor){

Serial.println("Authorized access");
    Serial.println();
    delay(500);
     digitalWrite(trava, HIGH);

   lcd.clear();
  lcd.setCursor(5,0);
  // print message
  lcd.print("ACESSO");
  lcd.setCursor(4,1);
  // print message
  lcd.print("LIBERADO!");
     tone(Buzzer,1000);
     delay(2000);
     digitalWrite(trava, LOW);
     noTone(Buzzer);
     lcd.clear();
     mensagem();
      
    
}else{

  delay(500);
   tone(Buzzer,1000);
    lcd.clear();
  lcd.setCursor(5,0);
  // print message
  lcd.print("ACESSO");
  lcd.setCursor(5,1);
  // print message
  lcd.print("NEGADO!");
  delay(1000);
  
  delay(2000);
  lcd.clear();
  noTone(Buzzer);
   mensagem();
    
  
}


return   ; 
}


void mensagem(){

lcd.setCursor(4,0);
  // print message
  lcd.print("EM MODO");
  lcd.setCursor(3,1);
  // print message
  lcd.print("DE ESPERA!");

return   ;
}
///////---------------------------------------------------------COMENTARIOS ADICIONAIS--------------------------------------------------------/////////


/*
 * 
RELE

CONEXAO DA DIREITA:D8.
CONEXÃO DO MEIO 3V.
CONEXÃO DA ESQUERDA GND.

*/



 
