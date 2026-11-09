<?php
function bersihkan($data): string
{
	if (!is_scalar($data)) {
		return "";
	}

	$data = trim((string) $data);
	$data = stripslashes($data);

	return htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
