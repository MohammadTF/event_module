<?php

interface WP_Post_type
{
	public $post_type;
	public function labels();
	public function isPublic();
	public function menuPosition();
	public function supports();
	public function listTaxonomies();
	public function menuIcon();
	public function hasArchive();
	public function addMetaBox();
	public function prePostSave();
	public function afterPostSave();
	public function includeTemplate();

}