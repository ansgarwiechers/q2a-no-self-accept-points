<?php

// don't allow this page to be requested directly from browser
if (!defined('QA_VERSION')) {
	header('Location: ../../');
	exit;
}

/**
 * Override the formula for calculating points for accepting answers to remove
 * accepted self-answers.
 */
function qa_db_points_calculations() {
	$points_calculations = qa_db_points_calculations_base();

	// Don't grant points for selecting a self-answer.
	if (array_key_exists('aselects', $points_calculations)) {
		$points_calculations['aselects']['formula'] = "COUNT(*) AS aselects FROM ^posts AS userid_src JOIN ^posts AS answers ON userid_src.selchildid=answers.postid WHERE userid_src.userid~ AND userid_src.type='Q' AND answers.userid<>userid_src.userid";
	} else {
		// if key 'aselects' is missing: throw a warning, but continue regardless
		trigger_error("Missing key 'aselects' in points calculations array", E_USER_WARNING);
	}

	// Also don't grant points for a self-answer being selected.
	// This is already the default behavior, but we enforce it here so that
	// changing the default behavior wouldn't break the functionality of this
	// plugin.
	if (array_key_exists('aselecteds', $points_calculations)) {
		$points_calculations['aselecteds']['formula'] = "COUNT(*) AS aselecteds FROM ^posts AS userid_src JOIN ^posts AS answers ON userid_src.selchildid=answers.postid WHERE userid_src.userid~ AND answers.type='A' AND answers.userid<>userid_src.userid";
	} else {
		// if key 'aselecteds' is missing: throw a warning, but continue regardless
		trigger_error("Missing key 'aselecteds' in points calculations array", E_USER_WARNING);
	}

	return $points_calculations;
}
