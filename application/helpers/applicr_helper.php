<?php

/**
 * Passage d'une date format EN (aaaa-mm-jj) au format AppliCR (jj-MMM-aaaa)
 */
function dateToAppliCR($dateEN) {
	return strtolower(date("d-M-Y", strtotime($dateEN)));
}

/**
 * Passage d'une date format AppliCR (jj-MMM-aaaa) au format EN (aaaa-mm-jj)
 */
function dateToEN($dateAppliCR) {
	return date("Y-m-d", strtotime($dateAppliCR));
}