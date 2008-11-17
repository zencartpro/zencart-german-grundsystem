#!/usr/local/bin/perl
# $Id: generate-btfiles.pl 151 2005-04-03 20:05:27Z dogu $
#
# (c) 2005 by Dominik Guder
# 
# Released under the GNU General Public License
#
# convert a blz text file into German Banktransfer files
# get full PC text file from www.bundesbank.de ->
# -> Zahlungsverkehr -> Bankleitzahlen -> Download
# filename looks like blzYYMMpc.zip 
# (blz0503pc.zip for March 2005)
# and unzip it
# 
# usage: generate-btfiles.pl blz0503pc.txt
# this will build three files in current directory:
# !!! Attention: existing files wil be overwritten !!!
#   - blz.csv -> for usage without database
#   - banktransfer_blz_split1.sql -> first part of mysql importfile
#   - banktransfer_blz_split2.sql -> second part of mysql importfile
#
# this file was developed under win32, it is completely untested on Linux
# some more adjustments and cleanups should be done

{

$numArgs = $#ARGV + 1;
die ("usage: $0 <filename>") if ($numArgs != 1);

$bblz=0;  # begin blz
$lblz=8;  # length blz
$bbankname=27;  # begin bankname
$lbankname=58;  # length bankname
$bort=110;     # begin ort
$lort=29;     # length ort
$bprz=181;     # begin prz
$lprz=2;  # lenght prz

($Second, $Minute, $Hour, $Day, $Month, $Year, $WeekDay, $DayOfYear, $IsDST) = localtime(time);
$createDate = sprintf("%04d-%02d-%02d %02d:%02d", $Year + 1900, ++$Month, $Day, $Hour, $Minute);
print "$createDate \n";

#printf("%04d-%02d-%02d %02d:%02d", $Year + 1900, ++$Month, $Day, $Hour, $Minute);

   open (CHECKBOOK, $ARGV[$argnum])|| die ("Could not open '$ARGV[0]': $!");

   while ($record = <CHECKBOOK>) {
      if (substr($record,0,1) != 0){
        if (substr($record,8,1) == 1){

          $blz=substr($record,$bblz,$lblz);
          $prz=substr($record,$bprz,$lprz);
          $bankname=substr($record,$bbankname,$lbankname);
          $bankname=~ s/\s+$//;
          $ort=substr($record,$bort,$lort);
          $ort=~ s/\s+$//;

          $bankname=sprintf("%s %s", $bankname, $ort) if (!($bankname =~ /$ort/));

          $entry = sprintf("%s;%s;%s\n", $blz, $bankname, $prz);
          push(@csvlist, $entry);
          # print $entry
          $mysqlEntry = sprintf("%s,'%s','%s'", $blz, $bankname, $prz);
          push(@blzlist, $mysqlEntry);
        }
      }
    }
    close(CHECKBOOK);

    $filename = "banktransfer_blz_split1.sql";
    print "Generate file $filename\n";
    open (SPLIT, "> $filename") || die ("Could not open $filename: $!");
    
    printHeader1() ;

    $count = @blzlist; 
   
    printEntries (0,int($count / 2));
    close (SPLIT);

  
    $filename = "banktransfer_blz_split2.sql";
    print "Generate file $filename\n";
    open (SPLIT, "> $filename") || die ("Could not open $filename: $!");
    
    printHeader2();
    printEntries (int($count / 2),$count);
    close (SPLIT);

    $filename = "blz.csv";
    print "Generate file $filename\n";
    open (CSV, "> $filename") || die ("Could not open $filename: $!");
    
    printCsvEntries ();
    close (CSV);
}

sub printHeader1 (){
  print SPLIT  "# SQL Dump for MySQL
#  
# created by blz converter generate-btfiles.pl
# generation time: $createDate
# generation file: $ARGV[0]
#
# based on phpMyAdmin SQL Dump
# version 2.5.3-rc1
# http://www.phpmyadmin.net
#

# --------------------------------------------------------

#
# Table structure for table `banktransfer_blz`
#

DROP TABLE IF EXISTS `banktransfer_blz`;
CREATE TABLE `banktransfer_blz` (
  `blz` int(10) NOT NULL default '0',
  `bankname` varchar(255) NOT NULL default '',
  `prz` char(2) NOT NULL default '',
  PRIMARY KEY  (`blz`)
) TYPE=MyISAM;

#
# Dumping data for table `banktransfer_blz`
#

INSERT INTO `banktransfer_blz` VALUES 
";
}

sub printHeader2 (){
  print SPLIT "# SQL Dump for MySQL
#  
# created by blz converter generate-btfiles.pl
# generation time: $createDate
# generation file: $ARGV[0]
#
# based on phpMyAdmin SQL Dump
# version 2.5.3-rc1
# http://www.phpmyadmin.net
#

# --------------------------------------------------------

#
# Dumping data for table `banktransfer_blz`
#

INSERT INTO `banktransfer_blz` VALUES 
";
}

sub printEntries()
{
  my($start, $end) = @_;
  my $i;
  for($i = $start ; $i < $end -1 ; $i++)
  {
    print SPLIT "($blzlist[$i]),\n"  ;
  } 
  print SPLIT "($blzlist[$i]);\n"  ;

}

sub printCsvEntries()
{
  foreach my $entryLine (@csvlist) {
    print CSV $entryLine;
  }
}


