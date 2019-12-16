# COBRA5 PHP SDK

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/5e7002b5deba43be88149231a8a5886c)](https://app.codacy.com/app/jr-cobweb/cobra5-php-sdk?utm_source=github.com&utm_medium=referral&utm_content=cobwebinfo/cobra5-php-sdk&utm_campaign=Badge_Grade_Settings)
[![Build Status](https://travis-ci.org/cobwebinfo/cobra5-php-sdk.svg?branch=master)](https://travis-ci.org/cobwebinfo/cobra5-php-sdk)

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/4ffd7142c5f74784a7eabae6baafc7a7)](https://www.codacy.com/app/jr-cobweb/cobra5-php-sdk?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=cobwebinfo/cobra5-php-sdk&amp;utm_campaign=Badge_Grade)

The COBRA5 API can be used to retrieve content from the [Cobweb Information Ltd](http://www.cobwebinfo.com) content API.

This repository contains the open source PHP SDK for integrating the COBRA5 API into your PHP application. The COBRA5 PHP SDK is licensed under the MIT license.

This package requires PHP `>= 7.0.0`. Please refer to version 1.0.x if you are using older versions of PHP.

In order to gain access to the COBRA5 API, you will require an API Key that will be issued by [Cobweb Information Ltd](http://www.cobwebinfo.com). You will also receive complete documentation on each of the resources of the COBRA5 API, as well as example requests and responses.

## Installation
Add `cobwebinfo/cobra5-php-sdk` as a requirement to `composer.json`:

```json
{
  "require": {
    "cobwebinfo/cobra5-php-sdk": "1.1.*"
  }
}
```

## Authentication
The COBRA5 API is based on open standards known collectively as web services, which includes Simple Object Access Protocal (SOAP), Web Services Definition Language (WSDL) and the XML Schema Definition Language (XSD).

In order to authenticate with the COBRA5 API, you will need to create a `SoapClient` and set the correct authorisation header. This can be achieved using the service classes within this repository:

First, create a new `SoapClient` and pass the URI of the WSDL:
```php
$soap = new SoapClient('http://api.cobwebinfo.com/server/soap?wsdl');
```

Next, create a new `SoapApiKeyAuthentication` object and pass the name of the `SoapHeader` and your `api_key` as arguments:
```php
use CobwebInfo\Cobra5Sdk\Authentication\SoapApiKeyAuthentication;

$auth = new SoapApiKeyAuthentication('Auth', 'api_key');
```

Next, create a new `Cobra5SoapClient` and pass the `SoapClient` and `SoapApiKeyAuthentication` objects as arguments:
```php
use CobwebInfo\Cobra5Sdk\Client\Cobra5SoapClient;

$client = new Cobra5SoapClient($soap, $auth);
```

Finally, create a new instance of `Cobra5` and pass the `Cobra5SoapClient` object as the argument:
```php
use CobwebInfo\Cobra5Sdk\Cobra5;

$cobra5 = new Cobra5($client);
```

## Return values
Each of the methods of the COBRA5 PHP SDK will return either a collection or an entity.

A collection is an iteratable object that implements a numer of helper methods for working with collections of resources. The collection will be an instance of `Illuminate\Support\Collection`.

Each entity has a number of methods that make working with entity objects easier. Certain entities also have additional helper methods. You can find the entity classes under `CobwebInfo\Cobra5Sdk\Entity`.

## Available methods
The following is a list of available methods and how you would call them on the `$cobra5` object. For a more detailed overview of the methods, requests and responses of the COBRA5 API, please consult the documentation that was provided with your API key.

```php
$cobra5->getStores();
```
The `getStores()` method will return a `Illuminate\Support\Collection` of the datastores that you have access to through your API key.

```php
$cobra5->getStore(9);
```
The `getStore()` method will return a `CobwebInfo\Cobra5Sdk\Entity\Datastore` instance.

```php
$cobra5->getStoreByName('BOP');
```
The `getStoreByName()` method will return a `CobwebInfo\Cobra5Sdk\Entity\Datastore` instance.

```php
$cobra5->getDocuments();
```
The `getDocuments()` method will return a `Illuminate\Support\Collection` of the documents that you have access to through your API key.

```php
$cobra5->getDocument(1444);
```
The `getDocument()` method will return a `CobwebInfo\Cobra5Sdk\Entity\Document` instance.

```php
$cobra5->getLastEditedDocument();
```
The `getLastEditedDocument()` method will return the last edited document in the system as a `CobwebInfo\Cobra5Sdk\Entity\Document` instance.

```php
$cobra5->getEditedDocuments('1388534400', '1391126400');
```
The `getEditedDocuments()` method will return a `Illuminate\Support\Collection` of documents that were edited between two unix timestamps.

```php
$cobra5->getDocumentsByDataStore(9);
```
The `getDocumentsByDataStore()` method will return a `Illuminate\Support\Collection` of documents that are available to you through a particular datastore.

```php
$cobra5->getDocumentsForCategory(1197);
```
The `getDocumentsForCategory()` method will return a `Illuminate\Support\Collection` of documents that are available to you through a particular category.

```php
$cobra5->getCategory(1197);
```
The `getCategory()` method will return a `CobwebInfo\Cobra5Sdk\Entity\Category` instance.

```php
$cobra5->getCategoriesForStore(9);
```
The `getCategoriesForStore()` method will return a `Illuminate\Support\Collection` of categories that are available to you through a particular datastore.

```php
$cobra5->getDocumentXml(1444);
```
The `getDocumentXml()` method will return the XML version of a document as a string.

```php
$cobra5->getDocumentPdf(1444);
```
The `getDocumentPdf()` method will return the PDF version of a document as a base64 encoded string.

```php
$cobra5->getDocumentHtml(1444);
```
The `getDocumentHtml(1444)` method will return the HTML version of a document as a string.

```php
$cobra5->documentSearch('business', 0, 10);
```
The `documentSearch()` method will allow you to search the API for a particular term. You will be returned a `Illuminate\Support\Collection` of results.

## Errors and Exceptions
If a problem occurs whilst using the COBRA5 API a `SoapFault` exception will be thrown. This exception can be caught and dealt with gracefully within your application:
```php
try
{
  $this->getDocument(999999999);
}

catch(SoapFault $e)
{
  // deal with error
}
```
