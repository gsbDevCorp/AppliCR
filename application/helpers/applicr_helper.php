<?php

/**
 * Passage d'une date format EN (aaaa-mm-jj) au format AppliCR (jj-MMM-aaaa)
 */
function dateToAppliCR($dateEN) {
	return strtolower(date("d-M-Y", strtotime($dateEN)));
}

/**
 * Passage d'une date format AppliCR au format EN (aaaa-mm-jj)
 */
function dateToEN($dateAppliCR) {
	return date("Y-m-d", strtotime($dateAppliCR));
}

/**
 * Vérifie que la date est bien au format jj/mm/aaaa 
 */
function verifierFormatDate($date) {
	return preg_match('#^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$#', $date);
}