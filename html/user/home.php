<?php
// This file is part of BOINC.
// http://boinc.berkeley.edu
// Copyright (C) 2008 University of California
//
// BOINC is free software; you can redistribute it and/or modify it
// under the terms of the GNU Lesser General Public License
// as published by the Free Software Foundation,
// either version 3 of the License, or (at your option) any later version.
//
// BOINC is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with BOINC.  If not, see <http://www.gnu.org/licenses/>.

require_once("../inc/util.inc");
require_once("../inc/boinc_db.inc");
require_once("../inc/user.inc");
require_once("../inc/forum.inc");
require_once("../inc/host.inc");
require_once("../inc/credit.inc");

check_get_args(array());

// show the home page of logged-in user

$user = get_logged_in_user();
BoincForumPrefs::lookup($user);
$user = get_other_projects($user);

$init = isset($_COOKIE['init']);
$via_web = isset($_COOKIE['via_web']);
if ($via_web) {
    clear_cookie('via_web');
}

$cache_control_extra = "no-store,";

if ($init) {
    clear_cookie('init');
    page_head(tra("Welcome to %1", PROJECT));
    echo "<p>".tra("View and edit your account preferences using the links below.")."</p>\n";
    if ($via_web) {
        echo "<p> "
        .tra("If you have not already done so, %1 download BOINC client software %2.", "<a href=\"https://boinc.berkeley.edu/download.php\">", "</a>")."</p>";
    }
} else {
    page_head(tra("Your account"));
}



// $total   = "total_score=".((string) $user->total_credit);
// $expavg   = "expavg_score=".((string) $user->expavg_credit);
// $created  = "registration_time=".((string) $user->create_time);
// $hosts    = BoincHost::enum("userid=$user->id");
// $n_hosts  = "cpus=".count($hosts);
// $scr_pnt  = $expavg."&".$created."&".$n_hosts."&".$total;

// $usr_url  = getenv("GIMMEFY_URL")."/user/";
// $img_url  = $usr_url.((string) $user->id)."/image?".$scr_pnt;
// $gnd_url  = $usr_url.((string) $user->id)."/gender/";
// $tip_url  = $usr_url.((string) $user->id)."/tip?".$scr_pnt;
// $lvl_url  = $usr_url.((string) $user->id)."/level?".$scr_pnt;


// $resp = file_get_contents($lvl_url);

// $resp = json_decode($resp);

// $key = "level";
// $level = $resp->$key;
// $key = "level_name";
// $level_name = $resp->$key;
// $key = "year";
// $year = $resp->$key;
// $key = "total_exp";
// $total_exp = (int) $resp->$key;
// $key = "year";
// $year = $resp->$key;
// if ($year === "") {
//     $year = "";
// } else {
//     $year = " (".$year.")";
// }


// // -----------

// $resp = file_get_contents($tip_url);

// $key = "text";
// $resp = json_decode($resp);
// $tip = $resp->$key;
// $tip_crd = "<div class=\"card\"><div class=\"card-body\">".$tip."</div></div>";

// $fimg     = "<img src=\"".$img_url."\" class=\"img\" onclick='return confirm(\"Я gimmefy-server\")' style=\"width:100%;\" border=\"10\">";

// $fact     = $gnd_url."?callback=".urlencode(url());
// $fbtn     = "<button class=\"button\" type=\"submit\" form=\"form1\" value=\"Submit\">".tra("Change avatar gender")."</button>";
// $fform    = "<form action=\"".$fact."\" method=\"post\" id=\"form1\">".$fbtn."</form>";
// $user_zpg = "<div class=\"container-fluid\">".$fimg.$fform;
// echo $user_zpg;

// row2("<b>Уровень:</b>", ((string) $level)." (".((string) ($total_exp))." pts)");
// echo "<br>";
// row2("<b>Звание:</b>", $level_name.$year);

// echo "<br>".$tip_crd."</div><br><br>";

show_account_private($user);


page_tail();

?>
