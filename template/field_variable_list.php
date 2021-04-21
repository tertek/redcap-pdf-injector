<?php

$response = "";
$fields = $_POST["fields"];

foreach ($fields as $key => $field) {

    if( empty($field["fieldValue"])) {
        $state = "is-empty";
        $text = "Variable is empty";
        $class = "warning";
    } else {
        $state = "";
        $text = "";
        $class = "";
    }
    
    $response .= '<div class="form-row align-items-center">';
    $response .= '<div class="col-auto">';
    $response .= '<label class="sr-only" for="inlineFormInputGroup"></label>';
    $response .= '<div class="input-group mb-2">';
    $response .= '<div class="input-group-prepend"><div class="input-group-text">'.$field["fieldName"].'</div></div>';
    $response .= '<input type="text" class="form-control '.$state.' variable-input" name="fields['.$field["fieldName"].']" id="fieldVariableMatch-'.$key.'" value="'.$field["fieldValue"].'" placeholder="" onfocusout="STPH_pdfInjector.validateField('.$key.');">';
    $response .= '</div></div><div class="col-auto"><div class="form-check mb-2"> <label class="form-check-label" for="autoSizingCheck">';
    $response .= '<small id="variableHelpLine-'.$key.'" class="text-'.$class.'">'.$text.'</small>';
    $response .= '</label></div></div></div>';
}

print $response;

?>
