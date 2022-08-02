
#klienci
TRUNCATE `mkinternet_crm_klienci`;

INSERT INTO `mkinternet_crm_klienci` 
(`id`,`firma`, `osoba`, `panstwo`, `kodmiasta`, 
`miasto`, `adres`, `telefon`, `komorka`, `nip`, `regon`, 
`adresemail`, `stronawww`, `kontohostingowe`, `abonament`, `adreskoperta`, `notatka`, `created_at`) 


SELECT `csId`, `csName`, CONCAT(`csOwnerName`,' ', `csOwnerSurname`),  `csCountry`, `csCityCode`, 
`csCity`, CONCAT(`csStreet`, `csStreetNo`), `csPhone`, `csMobile`,`csNip`, `csRegon`, 
`csEmail`, `csWeb`, `csNazwaKonta`, `csLicence`,  `csAdresKorespondencja`, `csNote`, FROM_UNIXTIME(`csCrDate`)

FROM `costumers`;

#uslugi 
TRUNCATE `mkinternet_crm_uslugi`;
INSERT INTO `mkinternet_crm_uslugi` 
(`id`, `nazwa`, `opis`, `klienci_id`, `cena`, 
`vat_id`, `created_at`, `updated_at`, `deleted_at`, `wygasa`, `faktury_id`, `zaplacona`) 

SELECT srId, srServiceName, srServiceDesc, srCostumerId, srNetAmount,
srVat, srAdded, NULL, NULL, NULL, srInvoice, srPayed FROM services;

UPDATE `mkinternet_crm_uslugi` SET vat_id=1 WHERE vat_id=23;
UPDATE `mkinternet_crm_uslugi` SET vat_id=2 WHERE vat_id=0;
UPDATE `mkinternet_crm_uslugi` SET vat_id=3 WHERE vat_id=22;

UPDATE `mkinternet_crm_uslugi` SET waluta='PLN';

#abonamenty

INSERT IGNORE INTO `mkinternet_crm_uslugi` 
(`id`, `nazwa`, `klienci_id`, `cena`, 
`vat_id`, `created_at`, `wygasa`, `faktury_id`, zaplacona) 

SELECT iiServiceId+2481, iiServiceName, liCostumerId, iiServiceAmount, iiVat, FROM_UNIXTIME(liAdded), FROM_UNIXTIME(liDateTo), iiInvoiceId, lipayed
FROM `invoice_item`, `licences`
where iiServiceName like 'hosting %'
and iiServiceId=liId;

UPDATE `mkinternet_crm_uslugi` SET vat_id=1 WHERE vat_id=23;
UPDATE `mkinternet_crm_uslugi` SET vat_id=2 WHERE vat_id=0;
UPDATE `mkinternet_crm_uslugi` SET vat_id=3 WHERE vat_id=22;

UPDATE `mkinternet_crm_uslugi` SET przedluzona=1 where not isnull(wygasa);


#faktury
TRUNCATE `mkinternet_crm_faktury`;
INSERT INTO `mkinternet_crm_faktury`
(`id`, `numer`, `datawystawienia`, `datasprzedazy`, `klienci_id`, `platnosc_id`, 
	`zaplacona`, `uwagi`, `terminplatnosci`, `created_at`)
SELECT inId, inInvoiceNo, inCrDate, inSellDate, inCostumerId, inPayType, 
	inPayed, inComment, inPayTerm, inCrDate 
FROM invoices;

UPDATE mkinternet_crm_faktury SET zaplacona=1 WHERE datawystawienia<'2018-01-01';
