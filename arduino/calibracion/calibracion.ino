#include <AlphaNumeric_Driver.h>
#include <FileIO.h>

#define NUMBER_OF_DISPLAYS 4
#define SDIPIN 11
#define CLKPIN 13
#define LEPIN 10
#define OEPIN 9

#define METHANEPIN 0
#define PIRPIN 7
#define LEDPIN 6
#define BEACONPIN 5

alphaNumeric myDisplay(SDIPIN, CLKPIN, LEPIN, OEPIN, NUMBER_OF_DISPLAYS);

char buf [5];

void setup() {
  
  Bridge.begin();
  FileSystem.begin();

  Serial.begin(9600);
  
  pinMode(LEDPIN, OUTPUT);
  pinMode(BEACONPIN, OUTPUT);
  //digitalWrite(LEDPIN, HIGH);

}

void loop () {

  String dataString;
  //dataString += getTimeStamp();
  //dataString += " = ";

  int methaneSensor = analogRead(METHANEPIN);
  dataString += String(methaneSensor) + " ";
  
  int pirSensor = digitalRead(PIRPIN);
  digitalWrite(LEDPIN, pirSensor);
  dataString += pirSensor == HIGH ? 1 : 0;

  // The FileSystem card is mounted at the following "/mnt/FileSystema1"
  File dataFile = FileSystem.open("/mnt/sd/datalog.txt", FILE_APPEND);

  if (dataFile) {
    dataFile.println(dataString);
    dataFile.close();
    Serial.println(dataString);
  } else {
    Serial.println("error opening datalog.txt");
  }
  
  sprintf (buf, "%04i", methaneSensor);
  myDisplay.scroll(buf, 0);

  digitalWrite(BEACONPIN, HIGH);
  delay(50);
  digitalWrite(BEACONPIN, LOW);
  delay(950);

}


//String getTimeStamp() {
//  String result;
//  Process time;
//  time.begin("date");
//  time.addParameter("+%F %T");
//  time.run();
//
//  while (time.available() > 0) {
//    char c = time.read();
//    if (c != '\n')
//      result += c;
//  }
//
//  return result;
//}


