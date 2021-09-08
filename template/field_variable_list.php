<?php
/**
 * Template file used via Ajax
 * 
 */

function sanitize($arg) {
    if (is_array($arg)) {
        return array_map('sanitize', $arg);
    }

    return htmlentities($arg, ENT_QUOTES, 'UTF-8');
}

$response = "";
$fields = sanitize($_POST["fields"]);

foreach ($fields as $key => $field ) {

    $fieldValue = $field["fieldValue"];

    if( empty($fieldValue)) {
        $state = "is-empty";
        $text = "Variable is empty";
        $class = "warning";
    } else {
        $state = "is-valid";
        $text = "Variable is valid.";
        $type = 'Type: '.$fieldValue["element_type"];
        $class = "success";
    }
    
    $response .= '<div class="form-row align-items-center">';
    $response .= '<div class="col-auto">';
    $response .= '<label class="sr-only" for="inlineFormInputGroup"></label>';
    $response .= '<div class="input-group mb-2">';
    $response .= '<div id="field-'.htmlspecialchars($key).'" class="input-group-prepend"><div class="input-group-text">'.$field["fieldName"].'</div></div>';
    $response .= '<input data-quick-fill-key="'.$key.'" data-quick-fill-value="'.$field["fieldName"].'" type="text" class="form-control '.$state.' variable-input" name="fields['.$field["fieldName"].']" id="fieldVariableMatch-'.htmlspecialchars($key).'" value="'.htmlspecialchars($fieldValue["field_name"]).'" placeholder="" onfocusout="STPH_pdfInjector.validateField('.htmlspecialchars($key).');">';
    $response .= '</div></div><div class="col-auto"><div class="form-check mb-2"> <label class="form-check-label" for="autoSizingCheck">';
    $response .= '<small id="variableHelpLine-'.$key.'" class="text-'.$class.'">'.$text.' '.$type.'</small>';
    $response .= '</label></div></div></div>';
}

print $response;

?>

