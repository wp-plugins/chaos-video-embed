<?php header("Content-type: text/css"); ?>

/* $Id: example.css,v 1.5 2006/03/27 02:44:36 pat Exp $ */

/*--------------------------------------------------
  REQUIRED to hide the non-active tab content.
  But do not hide them in the print stylesheet!
  --------------------------------------------------*/
.tabberlive .tabbertabhide {
 display:none;
}

/*--------------------------------------------------
  .tabber = before the tabber interface is set up
  .tabberlive = after the tabber interface is set up
  --------------------------------------------------*/
.tabber {
}
.tabberlive {
 margin-top:1em;
}

/*--------------------------------------------------
  ul.tabbernav = the tab navigation list
  li.tabberactive = the active tab
  --------------------------------------------------*/
ul.tabbernav
{
 margin:0;
 margin-bottom: 0px !important;
 padding: 3px 0;
 border-bottom: 0px solid #778;
 font-weight:bold;

}


ul.tabbernav li
{
 list-style: none;
 margin: 0;
 display: inline;
}

ul.tabbernav li a
{
 padding: 3px 0.5em;
 margin-left: 3px;
 border: 1px solid #778;
 border-bottom: none;

 text-decoration: none;
}

ul.tabbernav li a:link { color: #448; }
ul.tabbernav li a:visited { color: #667; }

ul.tabbernav li a:hover
{
 color: #000;
 background: #AAE;
 border-color: #227;
}

ul.tabbernav li.tabberactive a
{
 background-color: #880000;
 border-bottom: 0px solid #fff;
}

table.tabbernav th.tabberactive a
{
 background-color: #880000;
 border-bottom: 0px solid #fff;
}


ul.tabbernav li.tabberactive a:hover
{
 color: #000;
 background: white;
 border-bottom: 1px solid white;
}

/*--------------------------------------------------
  .tabbertab = the tab content
  Add style only after the tabber interface is set up (.tabberlive)
  --------------------------------------------------*/
.tabberlive .tabbertab {
 padding:0px;
 border:0px solid #aaa;
 border-top:0;

 /* If you don't want the tab size changing whenever a tab is changed
    you can set a fixed height */

 /* height:200px; */

 /* If you set a fix height set overflow to auto and you will get a
    scrollbar when necessary */

 /* overflow:auto; */
}

/* If desired, hide the heading since a heading is provided by the tab */
.tabberlive .tabbertab h2 {
 display:none;
}
.tabberlive .tabbertab h3 {
 display:none;
}

/* Example of using an ID to set different styles for the tabs on the page */
.tabberlive#tab1 {
}
.tabberlive#tab2 {
}
.tabberlive#tab2 .tabbertab {
 height:200px;
 overflow:auto;
}
