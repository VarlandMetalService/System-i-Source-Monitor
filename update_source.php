<?php

/**
 * This program is designed to sync source libraries on the System i with a Git repository. It does
 * this by maintaining a list of source libraries and the corresponding file paths in the Git
 * repository. This program performs three functions:
 *
 *    1. If a file exists in the source library but not in the Git repository, the file is added to
 *       the Git repository.
 *    2. If a file exists in the Git repository but not in the source library, the file is deleted
 *       from the Git repository.
 *    3. If a file exists in both places, the program computes the SHA1 hash for each file. If the
 *       hashes match, the file is unchanged an nothing needs to be done. If the hashes don't match,
 *       the file from the System i source library is copied into the Git repository as a
 *       replacement for what was previously in the Git repository.
 */

/**
 * @var    object[]  $libraries                 Array of source libraries to monitor and their
 *                                              corresponding path in the Git repo.
 * @var    string[]  $globalPatternsToIgnore    File patterns to ignore in every library.
 * @var    string[]  $globalExtensionsToIgnore  File extensions to ignore in every library.
 * @var    string[]  $globalFilesToIgnore       File names to ignore in every library.
 * @var    string    $pathToLocalRepo           Path to root of local repo.
 */
$libraries = array();
$libraries[] = (object)array('name'               => 'AP.OLIB\\DDSSRC',
                             'sourcePath'         => '\\\\qvarland3\\APOLIB\\DDSSRC.FILE\\',
                             'repoPath'           => 'AP.OLIB\\DDSSRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'AP.OLIB\\QS36PRC',
                             'sourcePath'         => '\\\\qvarland3\\APOLIB\\QS36PRC.FILE\\',
                             'repoPath'           => 'AP.OLIB\\QS36PRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'AP.SLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\APSLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'AP.SLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'COPY.LIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\COPYLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'COPY.LIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => TRUE);
$libraries[] = (object)array('name'               => 'FA.OLIB\\DDSSRC',
                             'sourcePath'         => '\\\\qvarland3\\FAOLIB\\DDSSRC.FILE\\',
                             'repoPath'           => 'FA.OLIB\\DDSSRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'FA.OLIB\\QS36PRC',
                             'sourcePath'         => '\\\\qvarland3\\FAOLIB\\QS36PRC.FILE\\',
                             'repoPath'           => 'FA.OLIB\\QS36PRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'FA.SLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\FASLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'FA.SLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'GL.OLIB\\QS36PRC',
                             'sourcePath'         => '\\\\qvarland3\\GLOLIB\\QS36PRC.FILE\\',
                             'repoPath'           => 'GL.OLIB\\QS36PRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'GL.SLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\GLSLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'GL.SLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'IN.OLIB\\DDSSRC',
                             'sourcePath'         => '\\\\qvarland3\\INOLIB\\DDSSRC.FILE\\',
                             'repoPath'           => 'IN.OLIB\\DDSSRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'IN.OLIB\\QS36PRC',
                             'sourcePath'         => '\\\\qvarland3\\INOLIB\\QS36PRC.FILE\\',
                             'repoPath'           => 'IN.OLIB\\QS36PRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'IN.SLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\INSLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'IN.SLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'MN.OLIB\\DDSSRC',
                             'sourcePath'         => '\\\\qvarland3\\MNOLIB\\DDSSRC.FILE\\',
                             'repoPath'           => 'MN.OLIB\\DDSSRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'MN.OLIB\\QS36PRC',
                             'sourcePath'         => '\\\\qvarland3\\MNOLIB\\QS36PRC.FILE\\',
                             'repoPath'           => 'MN.OLIB\\QS36PRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'MN.OLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\MNOLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'MN.OLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'MN.SLIB\\QCLSRC',
                             'sourcePath'         => '\\\\qvarland3\\MNSLIB\\QCLSRC.FILE\\',
                             'repoPath'           => 'MN.SLIB\\QCLSRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'MN.SLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\MNSLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'MN.SLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'OE.OLIB\\DDSSRC',
                             'sourcePath'         => '\\\\qvarland3\\OEOLIB\\DDSSRC.FILE\\',
                             'repoPath'           => 'OE.OLIB\\DDSSRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'OE.OLIB\\QS36PRC',
                             'sourcePath'         => '\\\\qvarland3\\OEOLIB\\QS36PRC.FILE\\',
                             'repoPath'           => 'OE.OLIB\\QS36PRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'OE.OLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\OEOLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'OE.OLIB\\QS36SRC\\',
                             'filesToIgnore'      => array('SORT1.MBR',
                                                           'SORT2.MBR',
                                                           'VARRESP.MBR'),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'OE.SLIB\\QCLSRC',
                             'sourcePath'         => '\\\\qvarland3\\OESLIB\\QCLSRC.FILE\\',
                             'repoPath'           => 'OE.SLIB\\QCLSRC\\',
                             'filesToIgnore'      => array('ECOUTPUT.MBR',
                                                           'TBKUPO.MBR',
                                                           'TVOUTPUT.MBR'),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'OE.SLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\OESLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'OE.SLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'OP.OLIB\\DDSSRC',
                             'sourcePath'         => '\\\\qvarland3\\OPOLIB\\DDSSRC.FILE\\',
                             'repoPath'           => 'OP.OLIB\\DDSSRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'OP.OLIB\\QS36PRC',
                             'sourcePath'         => '\\\\qvarland3\\OPOLIB\\QS36PRC.FILE\\',
                             'repoPath'           => 'OP.OLIB\\QS36PRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'OP.SLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\OPSLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'OP.SLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'PR.OLIB\\DDSSRC',
                             'sourcePath'         => '\\\\qvarland3\\PROLIB\\DDSSRC.FILE\\',
                             'repoPath'           => 'PR.OLIB\\DDSSRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'PR.OLIB\\QS36PRC',
                             'sourcePath'         => '\\\\qvarland3\\PROLIB\\QS36PRC.FILE\\',
                             'repoPath'           => 'PR.OLIB\\QS36PRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'PR.OLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\PROLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'PR.OLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'PR.SLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\PRSLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'PR.SLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'TR.OLIB\\DDSSRC',
                             'sourcePath'         => '\\\\qvarland3\\TROLIB\\DDSSRC.FILE\\',
                             'repoPath'           => 'TR.OLIB\\DDSSRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'TR.OLIB\\QS36PRC',
                             'sourcePath'         => '\\\\qvarland3\\TROLIB\\QS36PRC.FILE\\',
                             'repoPath'           => 'TR.OLIB\\QS36PRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'TR.SLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\TRSLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'TR.SLIB\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
$libraries[] = (object)array('name'               => 'VMSSCALL\\QCLSRC',
                             'sourcePath'         => '\\\\qvarland3\\VMSSCALL\\QCLSRC.FILE\\',
                             'repoPath'           => 'VMSSCALL\\QCLSRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => TRUE);
$libraries[] = (object)array('name'               => 'VMSSCALL\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\VMSSCALL\\QS36SRC.FILE\\',
                             'repoPath'           => 'VMSSCALL\\QS36SRC\\',
                             'filesToIgnore'      => array(),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => TRUE);
$globalPatternsToIgnore = array('/^.*##.MBR$/');
$globalExtensionsToIgnore = array('PGM');
$globalFilesToIgnore = array('.', '..');
$pathToLocalRepo = '\\\\vmsfiles\\IT\\GitHub\\VCMS\\';

/**
 * Processes given library object (single item from the global $libraries array.
 *
 * @param    object    $library   Library to process.
 * @param    boolean   $prompt    Whether or not to prompt the user to see if the user wants to
 *                                process this library. Defaults to TRUE, which will prompt user.
 *                                If FALSE, will not prompt user and will automatically process the
 *                                library.
 * @return  void
 */
function processLibrary($library, $prompt = TRUE) {

  // Reference global objects.
  global $globalPatternsToIgnore, $globalExtensionsToIgnore, $globalFilesToIgnore, $pathToLocalRepo;

  // Prompt user (if necessary).
  if ($prompt && !$library->disablePrompting) {
    echo("\nEnter 'YES' to process {$library->name} >> ");
    $response = stream_get_line(STDIN, 1024, PHP_EOL);
    if ($response != 'YES') return;
  }

  // Print message.
  echo("\n{$library->name}\n" . str_repeat('-', strlen($library->name)) . "\n");

  // Store full file path to this library in the local repo.
  $thisLibRepoPath = $pathToLocalRepo . $library->repoPath;

  // Check for files that need to be deleted from the repository (no longer exist in source).
  echo("\n1. Delete Unnecessary Files from Repo\n\n");
  $repoFiles = scandir($thisLibRepoPath);
  foreach ($repoFiles as $file) {
    if ($file == '.' || $file == '..') continue;
    if (!file_exists($library->sourcePath . $file)) {
      echo("   --> {$file}\n");
      unlink($thisLibRepoPath . $file);
    }
  }

  // Copy new and changed files to the local repo.
  echo("\n2. Copy New & Changed Files to Repo\n\n");
  $sourceFiles = scandir($library->sourcePath);
  foreach ($sourceFiles as $file) {
    $filesToIgnore = array_unique(array_merge($globalFilesToIgnore,
                                              $library->filesToIgnore));
    if (in_array($file, $filesToIgnore)) continue;
    $extensionsToIgnore = array_unique(array_merge($globalExtensionsToIgnore,
                                                   $library->extensionsToIgnore));
    $ext = pathinfo($library->sourcePath . $file, PATHINFO_EXTENSION);
    if (in_array($ext, $extensionsToIgnore)) continue;
    $patternsToIgnore = array_unique(array_merge($globalPatternsToIgnore,
                                                 $library->patternsToIgnore));
    foreach ($patternsToIgnore as $pattern) {
      if (preg_match($pattern, $file) == 1) continue 2;
    }
    if (!file_exists($thisLibRepoPath . $file)) {
      echo("   --> {$file} (New)\n");
      copy($library->sourcePath . $file, $thisLibRepoPath . $file);
    } else {
      $sha1Source = sha1_file($library->sourcePath . $file);
      $sha1Repo = sha1_file($thisLibRepoPath . $file);
      if ($sha1Source != $sha1Repo) {
        echo("   --> {$file} (Updated)\n");
        copy($library->sourcePath . $file, $thisLibRepoPath . $file);
      }
    }
  }

}

/**
 * Main program logic. Calls processLibrary function for each defined library.
 *
 * @return  void
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
