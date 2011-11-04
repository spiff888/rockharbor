# ROCKHARBOR Theme Base

This WordPress theme contains all of the necessary components for creating a 
subsite. Subsites require a few special files for themselves to customize the
colors.

## Usage

### Directory structure

At the very least, the following files should be created.

    /<theme_name>
        /img
            direction-icon.png
            feature-1-hover.png
            feature-2-hover.png
            header.jpg
            out.png
            twitter-icon.png
        /libs
            child_theme.php
        functions.php
        style.css

### Required files

#### CSS

The child theme CSS should only contain styles for that child theme that need to 
be overridden. This usually just includes colors, but can include styles that
utilize images.

#### Including the theme class

Also required is a class within `/libs` called `ChildTheme()`. It must
extend `RockharborThemeBase`. All that needs to be defined are the `$themeOptions` 
as explained in the base class.

Next, create a `functions.php` file

    function _include_theme() {
        require_once 'libs/child_theme.php';
        global $theme;
        $theme = new ChildTheme();
    }
    add_action('after_setup_theme', '_include_theme');

This is required because WordPress doesn't use OOP and includes files in the
opposite order one would suspect. It is needed to overwrite the global `$theme`.

#### A bit more

There are some images required by the subsites, indicated in the directory
structure.

### Required configuration

Below is a list of the configuration required in the WordPress backend once the
site is created:

- Menus needs to be created and assigned to the Main and Footer navigation areas
- Theme options need to be defined, as they do not fall back on the parent theme
- Site title in Settings > General needs to be defined
- Under Settings > Reading, change the front page to display a static page and 
choose your homepage
- Go to Network Admin (top right), then to Settings and make sure subsites are
allowed to upload content

### Homepage

The homepage is a static page that displays its content above the main nav bar,
and a list of blogs where the content normally is. Make sure to set up the front
page to be this static page under Settings > Reading.

There is a special shortcode for the homepage to show the default featured graphics
if you don't have any at the time. The default featured graphics are the "Who
Leads This Campus?" and "Why This City?" To enable them, use the following 
shortcode:

    [defaultfeature link1="http://example.com/link.html" link2="http://example.com/link.html"]

Where link1 is a link for the first feature and link2 is a link for the second
(probably static pages within the site).

## Specialness

_YAWPH_ (yah-ff)
Yet Another WordPress Hack - A hack to make WordPress work in the way you might
imagine it to, or to work in a way common programming practices would dictate.
While much of the site is made up of YAWPHs, I've only begun to document them
as of this commit.