<?php

/**
 
 Copyright (c) 2012, SMB Phone Inc.
 All rights reserved.
 
 Redistribution and use in source and binary forms, with or without
 modification, are permitted provided that the following conditions are met:
 
 1. Redistributions of source code must retain the above copyright notice, this
 list of conditions and the following disclaimer.
 2. Redistributions in binary form must reproduce the above copyright notice,
 this list of conditions and the following disclaimer in the documentation
 and/or other materials provided with the distribution.
 
 THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 
 The views and conclusions contained in the software and documentation are those
 of the authors and should not be interpreted as representing official policies,
 either expressed or implied, of the FreeBSD Project.
 
 */

// Set required imports
if ( !defined('ROOT') ) {
	define('ROOT', dirname(dirname(dirname(__FILE__))));
}
if ( !defined('APP') ) {
	define('APP', ROOT . '/app/');
}
 
require (APP . 'php/config/config.php');
require (APP . 'php/libs/mySQL/class-mysqldb.php');

$sResult = performTests();

function performTests() {
    $sTestsOutcome = '';
    $numErrors = 0;
    
    $sTestsOutcome = addInfo($sTestsOutcome, 'Checking MySQL driver...');
    if (!function_exists('mysql_get_host_info')) {
        $sTestsOutcome = addCriticalFailureEnd($sTestsOutcome, 'MySQL driver FAILURE!');
        return $sTestsOutcome;
    }
    $sTestsOutcome .= 'MySQL driver working!<br/>';
    // try {
    //     $DB = new mysqldb(APP_DB_NAME, APP_DB_HOST, APP_DB_USER, APP_DB_PASS);
    // } catch (Exception $ex) {
    //     $sTestsOutcome .= 'MySQL driver FAILURE!<br/>';
    // }
    // $sTestsOutcome .= 'MySQL driver working!<br/>';
    // $sTestsOutcome .= '<br/>';
     
    if ($numErrors > 0) {
        $sTestsOutcome = addEndWithErrors($sTestsOutcome, $numErrors);
    } else {
        $sTestsOutcome = addSuccessfullEnd($sTestsOutcome);
    }
    
    return $sTestsOutcome;
}

function addInfo($sTestsOutcome, $sMessage) {
    $sTestsOutcome .= '<div id="info">' . $sMessage . '<br/></div>';
    return $sTestsOutcome;
}

function addFailure($sTestsOutcome, $sMessage) {
    $sTestsOutcome .= '<div id="danger">' . $sMessage . '<br/></div>';
    return $sTestsOutcome;
}

function addSuccess($sTestsOutcome, $sMessage) {
    $sTestsOutcome .= '<div id="success">' . $sMessage . '<br/></div>';
    return $sTestsOutcome;
}

function addCriticalFailureEnd($sTestsOutcome, $sMessage) {
    $sTestsOutcome .= '<div id="danger">' . $sMessage . '<br/></div>';
    $sTestsOutcome .= '<div id="info">--------------------------------------------------------<br/></div>';
    $sTestsOutcome .= '<div id="danger">Testing failed due to CRITICAL FAILURE!<br/></div>';
    return $sTestsOutcome;
}

function addSuccessfulEnd($sTestsOutcome) {
    $sTestsOutcome .= '<br/>';
    $sTestsOutcome .= '<div id="info">--------------------------------------------------------<br/></div>';
    $sTestsOutcome .= '<div id="success">All tests succeeded!<br/></div>';
    return $sTestsOutcome;
}

function addEndWithErrors($sTestsOutcome, $numErrors) {
    $sTestsOutcome .= '<br/>';
    $sTestsOutcome .= '<div id="info">--------------------------------------------------------<br/></div>';
    $sTestsOutcome .= '<div id="success">Tests completed with ' . $numErrors . ' errors!<br/></div>';
    return $sTestsOutcome;
}


?>

<html>
<head>
<title>Example Identity Provider - Test Service</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <div id="tests_outcome">
	<?php echo $sResult; ?>
    </div>
	
</body>
</html>
