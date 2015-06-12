<?php

/**
 * This program is designed to sync source libraries on the System i with a Git repository. It does this by maintaining
 * a list of source libraries and the corresponding file paths in the Git repository. This program performs three
 * functions:
 *
 *    1. If a file exists in the source library but not in the Git repository, the file is added to the Git repository.
 *    2. If a file exists in the Git repository but not in the source library, the file is deleted from the Git
 *       repository.
 *    3. If a file exists in both places, the program computes the SHA1 hash for each file. If the hashes match, the
 *       file is unchanged an nothing needs to be done. If the hashes don't match, the file from the System i source
 *       library is copied into the Git repository as a replacement for what was previously in the Git repository.
 */

/**
 * @var		object[]	$libraries									Array of source libraries to monitor and their corresponding path in the
 *																							Git repo.
 * @var		string[]	$globalPatternsToIgnore		Array of file patterns to ignore in every source library.
 * @var		string[]	$globalExtensionsToIgnore	Array of file extensions to ignore in every source library.
 * @var		string[]	$globalFilesToIgnore				Array of file names to ignore in every source library.
 */
$libraries = array();
$libraries[] = (object)array('name'								=>	'OE.SLIB\\QS36SRC',
														 'sourcePath'					=>	'\\\\qvarland3\\OESLIB\\QS36SRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\OE.SLIB\\QS36SRC\\',
														 'filesToIgnore'			=>	array(),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$libraries[] = (object)array('name'								=>	'OE.SLIB\\QCLSRC',
														 'sourcePath'					=>	'\\\\qvarland3\\OESLIB\\QCLSRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\OE.SLIB\\QCLSRC\\',
														 'filesToIgnore'			=>	array('ECOUTPUT.MBR', 'TBKUPO.MBR', 'TVOUTPUT.MBR'),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$libraries[] = (object)array('name'								=>	'OE.OLIB\\DDSSRC',
														 'sourcePath'					=>	'\\\\qvarland3\\OEOLIB\\DDSSRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\OE.OLIB\\DDSSRC\\',
														 'filesToIgnore'			=>	array(),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$libraries[] = (object)array('name'								=>	'OE.OLIB\\QS36PRC',
														 'sourcePath'					=>	'\\\\qvarland3\\OEOLIB\\QS36PRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\OE.OLIB\\QS36PRC\\',
														 'filesToIgnore'			=>	array(),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$libraries[] = (object)array('name'								=>	'OE.OLIB\\QS36SRC',
														 'sourcePath'					=>	'\\\\qvarland3\\OEOLIB\\QS36SRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\OE.OLIB\\QS36SRC\\',
														 'filesToIgnore'			=>	array('SORT1.MBR', 'SORT2.MBR', 'VARRESP.MBR'),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$libraries[] = (object)array('name'								=>	'VMSSCALL\\QS36SRC',
														 'sourcePath'					=>	'\\\\qvarland3\\VMSSCALL\\QS36SRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\VMSSCALL\\QS36SRC\\',
														 'filesToIgnore'			=>	array(),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$libraries[] = (object)array('name'								=>	'VMSSCALL\\QCLSRC',
														 'sourcePath'					=>	'\\\\qvarland3\\VMSSCALL\\QCLSRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\VMSSCALL\\QCLSRC\\',
														 'filesToIgnore'			=>	array(),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$libraries[] = (object)array('name'								=>	'COPY.LIB\\QS36SRC',
														 'sourcePath'					=>	'\\\\qvarland3\\COPYLIB\\QS36SRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\COPY.LIB\\QS36SRC\\',
														 'filesToIgnore'			=>	array(),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$libraries[] = (object)array('name'								=>	'PR.SLIB\\QS36SRC',
														 'sourcePath'					=>	'\\\\qvarland3\\PRSLIB\\QS36SRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\PR.SLIB\\QS36SRC\\',
														 'filesToIgnore'			=>	array(),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$libraries[] = (object)array('name'								=>	'PR.OLIB\\QS36SRC',
														 'sourcePath'					=>	'\\\\qvarland3\\PROLIB\\QS36SRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\PR.OLIB\\QS36SRC\\',
														 'filesToIgnore'			=>	array(),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$libraries[] = (object)array('name'								=>	'PR.OLIB\\QS36PRC',
														 'sourcePath'					=>	'\\\\qvarland3\\PROLIB\\QS36PRC.FILE\\',
														 'repoPath'						=>	'\\\\vmsfiles\\IT\\GitHub\\VCMS\\PR.OLIB\\QS36PRC\\',
														 'filesToIgnore'			=>	array(),
														 'extensionsToIgnore'	=>	array(),
														 'patternsToIgnore'		=>	array());
$globalPatternsToIgnore = array('/^.*##.MBR$/');
$globalExtensionsToIgnore = array('PGM');
$globalFilesToIgnore = array('.', '..');

/**
 * Processes given library object (single item from the global $libraries array.
 *
 * @param		object		$library		Library to process.
 * @param		boolean		$prompt			Whether or not to prompt the user to see if the user wants to process this library.
 *																Defaults to TRUE, which will prompt user. If FALSE, will not prompt user and will
 *																automatically process the library.
 * @return	void
 */
function processLibrary($library, $prompt = TRUE) {

	// Reference global arrays.
	global $globalPatternsToIgnore, $globalExtensionsToIgnore, $globalFilesToIgnore;
	
	// Prompt user (if necessary).
	if ($prompt) {
		echo("\nEnter 'YES' to process {$library->name} >> ");
		$response = stream_get_line(STDIN, 1024, PHP_EOL);
		if ($response != 'YES') return;
	}

	// Print message.
	echo("\n{$library->name}\n" . str_repeat('-', strlen($library->name)) . "\n");
	
	// Check for files that need to be deleted from the repository because they no longer exist in the source.
	echo("\n1. Delete Unnecessary Files from Repo\n\n");
	$repoFiles = scandir($library->repoPath);
	foreach ($repoFiles as $file) {
		if ($file == '.' || $file == '..') continue;
		if (!file_exists($library->sourcePath . $file)) {
			echo("   --> {$file}\n");
			unlink($library->repoPath . $file);
		}
	}
	
	// Copy files that don't exist in repo at all.
	echo("\n2. Copy New & Changed Files to Repo\n\n");
	$sourceFiles = scandir($library->sourcePath);
	foreach ($sourceFiles as $file) {
		$filesToIgnore = array_unique(array_merge($globalFilesToIgnore, $library->filesToIgnore));
		if (in_array($file, $filesToIgnore)) continue;
		$extensionsToIgnore = array_unique(array_merge($globalExtensionsToIgnore, $library->extensionsToIgnore));
		$ext = pathinfo($library->sourcePath . $file, PATHINFO_EXTENSION);
		if (in_array($ext, $extensionsToIgnore)) continue;
		$patternsToIgnore = array_unique(array_merge($globalPatternsToIgnore, $library->patternsToIgnore));
		foreach ($patternsToIgnore as $pattern) {
			if (preg_match($pattern, $file) == 1) continue 2;
		}
		if (!file_exists($library->repoPath . $file)) {
			echo("   --> {$file} (New)\n");
			copy($library->sourcePath . $file, $library->repoPath . $file);
		} else {
			$sha1Source = sha1_file($library->sourcePath . $file);
			$sha1Repo = sha1_file($library->repoPath . $file);
			if ($sha1Source != $sha1Repo) {
				echo("   --> {$file} (Updated)\n");
				copy($library->sourcePath . $file, $library->repoPath . $file);
			}
		}
	}

}

/**
 * Main program logic. Calls processLibrary function for each defined library.
 *
 * @return	void
 */
function main() {

	// Reference global $libraries array.
	global $libraries;
	
	// Print welcome message on screen.
	echo("VCMS Source Code Monitor\n========================\n");
	
	// Prompt user to see if all libraries should be processed without prompting.
	$promptEachLibrary = TRUE;
	echo("\nEnter 'ALL' to process all libraries without further prompting >> ");
	$response = stream_get_line(STDIN, 1024, PHP_EOL);
	if ($response == 'ALL') $promptEachLibrary = FALSE;
	
	// Process each library.
	foreach ($libraries as $lib) { processLibrary($lib, $promptEachLibrary); }
	echo("\n");
	
}

/** Execute main function. */
main();

?>