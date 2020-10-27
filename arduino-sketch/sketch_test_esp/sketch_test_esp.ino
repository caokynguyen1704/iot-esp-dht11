#include <dht_nonblocking.h>

#define DHT_SENSOR_TYPE DHT_TYPE_11
static const int DHT_SENSOR_PIN = D2;

DHT_nonblocking dht_sensor( DHT_SENSOR_PIN, DHT_SENSOR_TYPE );
void setup( )
{
  Serial.begin( 9600 );
  Serial.println("Makerlab demo DHT nonblocking");
}
static bool measure_environment( float *temperature, float *humidity )
{
  static unsigned long measurement_timestamp = millis( );

  if( millis( ) - measurement_timestamp > 2000ul )
  {
    if( dht_sensor.measure( temperature, humidity ) == true )
    {
      measurement_timestamp = millis( );
      return( true );
    }
  }
  return( false );
}

void loop( )
{
  float temperature;
  float humidity;
  if( measure_environment( &temperature, &humidity ) == true )
  {
    Serial.print( "Temperature = " );
    Serial.print( temperature, 1 );
    Serial.print( " *C,tHumidity = " );
    Serial.print( humidity, 1 );
    Serial.println( "%" );
  }
}
