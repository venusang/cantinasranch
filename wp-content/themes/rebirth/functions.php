<?php
// Include SD Frameworks
// ----------------------------------------------------------------------

// Localization Functionality
load_theme_textdomain('rebirth');

// Option tree for theme settings
require('_framework/option-tree.php');

// Initial Load
require('_framework/initial-load.php');

// Widget Framework
require('_framework/widgets.php');

// Enhanced Custom Fields Framework
require('_framework/enhanced-custom-fields/enhanced-custom-fields.php');

// Add theme support for post thumbnails & post formats
require('_theme_settings/add-theme-support.php');

// Include Custom Theme Settings/Options
require('_theme_settings/theme-options.php');
require('_theme_settings/theme-post-types.php');
require('_theme_settings/theme-custom-fields.php');
require('_theme_settings/theme-widgets.php');
require('_theme_settings/theme-functions.php');
require('_theme_settings/register-sidebars.php');
require('_theme_settings/theme-shortcodes.php');
?>