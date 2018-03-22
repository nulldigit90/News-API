# README #

This README would normally document whatever steps are necessary to get your application up and running.

### What is this repository for? ###

ZipNews
Version 0.3
Using https://newsapi.org/ to grab headlines and general news
This is a lib, and will later be turned into a wordpress plugin

### How do I get set up? ###

Have a working server that can handle php
Put in your api key from newsapi.org

$sources is an array containing a source list can use any from here https://newsapi.org/sources
	defaults to ["ign", "hacker-news", "techradar", "wired", "the-next-web", "techcrunch"]
	
$pagesize is an int with max being 100
	defaults to 10
	
$headlines is bool, true is just headlines, false is everything
	defaults to true

$news_object = new News($sources, $pagesize, $headlines);
$news_object->zipnews();

echos out li tags with 2 headers, and img and p of the information. Each have css classes

css file included.

