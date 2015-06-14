# System i Source Monitor

This command line PHP script is used to monitor source files on the System i and sync the libraries on the System i with the local Git repository.

**Before running this script, you must have an up-to-date local copy of the Git repository. Also, if you process all the libraries for changes, this script will take at least a few minutes to run. You will see messages on the screen so you know how far along the script is, but it is not super fast.**

The script works by performing three functions:

1. Files that exist in the local repo but not on the System i are removed from the local copy of the repo.
2. Files that exist on the System i but not in the local repo are added to the local copy of the repo.
3. Files that exist in both places are copied from the System i to the local repo if the file has changed.

To determine if a file has changed, the PHP function [`sha1_file`](http://php.net/sha1_file) is used to generate a SHA1 checksum on both copies of the file. If the checksums are different, overwrite the repo copy with the System i copy.

#### Global Options

There are three global option arrays used in this script: `$globalPatternsToIgnore`, `$globalExtensionsToIgnore`, and `$globalFilesToIgnore`.

- The `$globalPatternsToIgnore` is the most powerful of these options, because it could essentially perform the function of the other two arrays. The other arrays are maintained for simplicity. `$globalPatternsToIgnore` is an array of regular expressions. Each regular expression is tested against each file on the System i. If the file name matches the regular expression, the file is skipped. The regular expressions are evaluated using the PHP function [`preg_match`](http://php.net/manual/en/function.preg-match.php). A good example of the use of this array is the expression `/^.*##.MBR$/`. This regular expression basically prevents any file whose name ends with "##.MBR" from being copied to the repository. [PHP Live Regex](http://www.phpliveregex.com/) is a good resource for building regular expressions.
- `$globalExtensionsToIgnore` is an array of file extensions to skip. For example, compiled programs on the System i are named with a .PGM extension, so "PGM" is included in the array of file extensions to skip.
- Similar to `$globalExtensionsToIgnore`, `$globalFilesToIgnore` is an array of full filenames to skip.

#### Single Library Definition

Each library is defined by a block of code like the following:

```php
$libraries[] = (object)array('name'               => 'OE.OLIB\\QS36SRC',
                             'sourcePath'         => '\\\\qvarland3\\OEOLIB\\QS36SRC.FILE\\',
                             'repoPath'           => 'OE.OLIB\\QS36SRC\\',
                             'filesToIgnore'      => array('SORT1.MBR',
                                                           'SORT2.MBR',
                                                           'VARRESP.MBR'),
                             'extensionsToIgnore' => array(),
                             'patternsToIgnore'   => array(),
                             'disablePrompting'   => FALSE);
```

- The `name` field is simply a human friendly name used within the script.
- The `sourcePath` and `repoPath` fields define the full network paths for the files on the System i and the local repository.
- The `filesToIgnore`, `extensionsToIgnore`, and `patternsToIgnore` arrays function the same way as the global arrays, but are specific to this library.
- The `disablePrompting` gives the ability to disable prompting about whether or not to scan the library for changes. By default, the program prompts the user about whether or not the user wants to scan each library for changes. For some libraries, like the libraries for copy members and call programs, this prompt option is disabled since changes in those libraries are so common.

#### Library List

The following libraries are monitored by this script:

Library | Files
------- | -----
AP.OLIB | DDSSRC<br />QS36PRC
AP.SLIB | QS36SRC
COPY.LIB | QS36SRC
FA.OLIB | DDSSRC<br />QS36PRC
FA.SLIB | QS36SRC
GL.OLIB | QS36PRC
GL.SLIB | QS36SRC
IN.OLIB | DDSSRC<br />QS36PRC
IN.SLIB | QS36SRC
MN.OLIB | DDSSRC<br />QS36PRC<br />QS36SRC
MN.SLIB | QCLSRC<br />QS36SRC
OE.OLIB | DDSSRC<br />QS36PRC<br />QS36SRC
OE.SLIB | QCLSRC<br />QS36SRC
OP.OLIB | DDSSRC<br />QS36PRC
OP.SLIB | QS36SRC
PR.OLIB | DDSSRC<br />QS36PRC<br />QS36SRC
PR.SLIB | QS36SRC
TR.OLIB | DDSSRC<br />QS36PRC
TR.SLIB | QS36SRC
VMSSCALL | QCLSRC<br />QS36SRC
