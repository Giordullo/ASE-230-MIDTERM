<?php

function console_log($output, $with_script_tags = true) // Console Logging for Error Handling
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

function getCSVArray($fileName) // Read CSV file and convert to a PHP Array
{
    return $arr = array_map('str_getcsv', file($fileName));
}


function getCSVElement($fileName, $index) // Read CSV file and return indexed Element
{
    $arr = array_map('str_getcsv', file($fileName));
    return $arr[$index];
}


function addCSVRecord($fileName, $index, $record) // Add new record to the end of the CSV file
{
    $array = getCSVArray($fileName); // Get CSV Array

    $handle = fopen($fileName, "w"); // Open Write Handle to CSV File

    $i = 0;
    foreach ($array as $item) // Add Record to CSV File
    {
        if ($i == $index)
            array_push($item, $record);

        fputcsv($handle, $item);
        $i++;
    }

    if ($index == -1)
    {
        fputcsv($handle, $record);
    }

    if ($index >= count($array))
    {
        $recordArray = [$record];
        fputcsv($handle, $recordArray);
    }

    fclose($handle); // Close Handle
}


function addCSVRecordLine($fileName, $record) // Add new record to the end of the CSV file
{
    $array = getCSVArray($fileName); // Get CSV Array

    $handle = fopen($fileName, "w"); // Open Write Handle to CSV File

    foreach ($array as $item)
    {
        fputcsv($handle, $item);
    }
    fputcsv($handle, $record); // Add Line to CSV File

    fclose($handle); // Close Handle
}


function modifyRecord($fileName, $index, $quote, $record) // Modify an exsisting record in the CSV file
{
    $array = getCSVArray($fileName); // Get CSV Array

    $handle = fopen($fileName, "w"); // Open Write Handle to CSV File

    $i = 0;
    foreach ($array as $item) // Edit Record in CSV File
    {
        if ($i == $index)
        {
            $itemIndex = array_search($quote, $item);
            $item[$itemIndex] = $record;
        }

        fputcsv($handle, $item);
        $i++;
    }

    fclose($handle); // Close Handle
}

function modifyAuthorRecord($fileName, $index, $record) // Modify an exsisting record in the CSV file
{
    $array = getCSVArray($fileName); // Get CSV Array

    $handle = fopen($fileName, "w"); // Open Write Handle to CSV File

    $i = 0;
    foreach ($array as $item) // Edit Record in CSV File
    {
        if ($i == $index)
        {
            $item[0] = $record[0];
            $item[1] = $record[1];
        }

        fputcsv($handle, $item);
        $i++;
    }

    fclose($handle); // Close Handle
}


function EmptyCSVQuote($fileName, $index, $quote) // Empty Line in CSV
{
    $array = getCSVArray($fileName); // Get CSV Array

    $handle = fopen($fileName, "w"); // Open Write Handle to CSV File

    $i = 0;
    foreach ($array as $item) // Empty Record in CSV File
    {
        if ($i == $index)
        {
            $itemIndex = array_search($quote, $item);
            unset($item[$itemIndex]);
        }

        fputcsv($handle, $item);
        $i++;
    }

    fclose($handle); // Close Handle
}

function EmptyCSVAuthor($fileName, $index) // Empty Line in CSV
{
    $quotesName;

    if ($fileName[0] == "." && $fileName[1] == "." && $fileName[2] == "/")
        $quotesName = "../quotes.csv";
    else
        $quotesName = "quotes.csv";

    $array = getCSVArray($fileName); // Get CSV Array
    $quotes = getCSVArray($quotesName);

    $handle = fopen($fileName, "w"); // Open Write Handle to CSV File

    $i = 0;
    foreach ($array as $item) // Empty Record in CSV File
    {
        $isRemoved = false;
        if ($i == $index)
        {
            $isRemoved = true;
        }

        if (!$isRemoved)
            fputcsv($handle, $item);

        $i++;
    }

    fclose($handle); // Close Handle

    // Clear Quotes from Author
    $handleQ = fopen($quotesName, "w"); // Open Write Handle to CSV File

    $i = 0;
    foreach ($quotes as $item) // Empty Record in CSV File
    {
        $isRemoved = false;
        if ($i == $index)
        {
            $isRemoved = true;
        }

        if (!$isRemoved)
            fputcsv($handleQ, $item);

        $i++;
    }

    fclose($handleQ); // Close Handle
}


function DeleteCSVLine($fileName, $authorIndex) // Delete Line from CSV
{
    $array = getCSVArray($fileName); // Get CSV Array

    $handle = fopen($fileName, "w"); // Open Write Handle to CSV File

    $i = 0;
    foreach ($array as $item) // Empty Line in CSV File
    {
        if ($i == $index)
            fputcsv($handle, "");
        else
            fputcsv($handle, $item);
        $i++;
    }

    fclose($handle); // Close Handle
}


?>