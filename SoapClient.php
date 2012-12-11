<?php

/**
 * @package Misc
 */
class Misc_SoapClient
{


    public static function getDataFromRemoteService()
    {
        /*
        This is the return object that comes back from the Soap method.
        
        <xs:Return>
            <xs1:Company>
                <xs1:Name>
                    <xs1:Short>ATC</xs1:Short>
                    <xs1:Long>All Things Code</xs1:Long>
                </xs1:Name>
            </xs1:Company>

            <xs2:Customer>
                <xs2:Name>
                    <xs2:First>John</xs2:First>
                    <xs2:Middle>C</xs2:Middle>
                    <xs2:Last>Doe</xs2:Last>
                </xs2:Name>
            </xs2:Customer>
        </xs:Return>
        */

        // The service
        //   contains multiple entities with the same name, but different namespaces.
        //   The PHP SoapClient library is not able to differentiate between
        //   multiple entities with the same name and different namespaces.

        // This classmap has 2 elements for "Name", so does not work as intended.
        $classMap = array(
            'Return'   => 'Misc_SoapClient_ValueObjects_Return',
            'Company'  => 'Misc_SoapClient_ValueObjects_Return_Company',
            'Name'     => 'Misc_SoapClient_ValueObjects_Return_Company_Name',   // Company Name
            'Customer' => 'Misc_SoapClient_ValueObjects_Return_Customer',
            'Name'     => 'Misc_SoapClient_ValueObjects_Return_Customer_Name'   // Customer Name
            );
        $soapClientOptions = array(
            'classmap'       => $classMap,
            'location'       => 'wsdl.xml',
            'keep_alive'     => false,
            'exceptions'     => false,
            'trace'          => 1,      // allows access to request and response xml
            'cache_wsdl'     => WSDL_CACHE_NONE
            );
        $mySoapClient = new SoapClient( 'wsdl.xml', $soapClientOptions );

        // Returns an "xs:Return" element
        $retrievedData = $mySoapClient->getData();


        // @TODO Do some stuff with our retrieved data
    }
}
