<?php // Themes Options Menu

$themename = "ReviewIt";
$dirname = "reviewit";
$shortname = "theme";
$page_handle = $shortname . '-options';
$options = array (

array(	"name" => "General Settings",
      	"type" => "title"),

		array(	"type" => "open",
      	"id" => $shortname."_general_settings"),

 		array(  
		"name" => "Theme Skin",
        "desc" => "",
        "id" => $shortname."_skin",
        "std" => "Default",
		"options" => array('Default', 'Light'),
        "type" => "select"),

		array("type" => "divider"), 
		
		array(
		"name" => "Custom Logo",
        "desc" => "Enter your own logo image URL here (e.g. http://www.example.com/images/imagename.jpg)",
        "id" => $shortname."_custom_logo",
        "std" => "",
        "extras" => "uploadbutton",
        "type" => "text"),

		array("type" => "divider"),  
		
		array(  
		"name" => "Display Compact/Extend Panel on...",
        "desc" => "Homepage",
        "id" => $shortname."_home_ce",
        "type" => "checkbox"),

		array(  
		"name" => "",
        "desc" => "General categories",
        "id" => $shortname."_gen_cat_ce",
        "type" => "checkbox"),

		array(  
		"name" => "",
        "desc" => "Review categories",
        "id" => $shortname."_review_cat_ce",
        "type" => "checkbox"),
        
		array("type" => "divider"), 
		
		array(  
		"name" => "Community Links",
        "desc" => "Choose whether to display the register, login and profile links at the top of the page.",
        "id" => $shortname."_community_links",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

		array("type" => "divider"), 
		
		array(  
		"name" => "Breadcrumbs",
        "desc" => "Choose whether to display the breadcrumb navigation on each page.",
        "id" => $shortname."_breadcrumbs",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),
		
		array("type" => "divider"), 

		array(
		"name" => "Search Posts & Pages",
        "desc" => "Choose whether to exclude posts and pages from searches.",
        "id" => $shortname."_search_criteria",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),
        
		array("type" => "divider"),
		
		array(
		"name" => "TimThumb Image Resizer",
        "desc" => "If your images are not working on your website try disabling this option. <em>Note: This will mean your images will no longer be automatically cropped proportionally.</em>",
        "id" => $shortname."_timthumb",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),
		
		array("type" => "divider"), 
		
		array(  
		"name" => "RSS Feed Button",
        "desc" => "Display the RSS feed button with the default RSS feed or enter a custom feed below.",
        "id" => $shortname."_rss_button",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),
        
		array(
		"name" => "RSS URL",
        "id" => $shortname."_rss",
        "std" => "",
        "type" => "text"),
		
		array(
		"name" => "Email Address",
        "id" => $shortname."_email",
        "std" => "",
        "type" => "text"),
        
        array(
		"name" => "Twitter URL",
        "id" => $shortname."_twitter",
        "std" => "",
        "type" => "text"),
        
        array(
		"name" => "Myspace URL",
        "id" => $shortname."_myspace",
        "std" => "",
        "type" => "text"),
        
        array(
		"name" => "Facebook URL",
        "id" => $shortname."_facebook",
        "std" => "",
        "type" => "text"),
        
        array(
		"name" => "Digg URL",
        "id" => $shortname."_digg",
        "std" => "",
        "type" => "text"),    
                
        array(
		"name" => "Flickr URL",
        "id" => $shortname."_flickr",
        "std" => "",
        "type" => "text"),

        array(
		"name" => "Delicious URL",
        "id" => $shortname."_delicious",
        "std" => "",
        "type" => "text"),

        array(
		"name" => "YouTube URL",
        "id" => $shortname."_youtube",
        "std" => "",
        "type" => "text"),
        
		array("type" => "divider"), 
		
        array(
		"name" => "Favicon URL (.ico)",
        "desc" => "Type the URL of your favicon image (.ico, 16x16 or 32x32)",
        "id" => $shortname."_favicon_ico",
        "std" => "",
        "extras" => "uploadbutton",
        "type" => "text"),

        array(
		"name" => "Favicon URL (.png)",
        "desc" => "Type the URL of your favicon image (.png, 16x16 or 32x32)",
        "id" => $shortname."_favicon_png",
        "std" => "",
        "extras" => "uploadbutton",
        "type" => "text"),

         array(
		"name" => "Apple Icon URL (.png)",
        "desc" => "Type the URL of your apple icon image (.png, 57x57), used for display on the Apple iPhone",
        "id" => $shortname."_apple_icon",
        "std" => "",
        "extras" => "uploadbutton",
        "type" => "text"),

		array("type" => "divider"), 
		
		array(
		"name" => "Footer Content",
        "desc" => "Enter the content you want to display in your footer",
        "id" => $shortname."_footer_content",
        "std" => "",
        "type" => "textarea"),

		array("type" => "divider"), 
		
		array(
		"name" => "Scripts",
        "desc" => "Enter any scripts that need to be embedded into your theme (e.g. Google Analytics)",
        "id" => $shortname."_scripts",
        "std" => "",
        "type" => "textarea"),
        
		array("type" => "close"),	

array(	"name" => "Homepage Settings",
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $shortname."_homepage_settings"),

		array(  
		"name" => "Homepage Sidebar",
        "desc" => "Choose whether to disable the sidebar on the homepage.",
        "id" => $shortname."_homepage_sidebar",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

		array("type" => "close"),	

array(	"name" => "Post Category Settings",
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $shortname."_post_category_settings"),
      	
		array(  
		"name" => "Post Category Display",
        "desc" => "Choose how to display your posts in categories.",
        "id" => $shortname."_gen_cat_display",
        "std" => "List",
		"options" => array('List', 'Compact Boxes', 'Extended Boxes'),
        "type" => "select"),
 
		array("type" => "divider"), 

		array(  
		"name" => "Post Category Sidebar",
        "desc" => "Choose whether to display the sidebar on general categories.",
        "id" => $shortname."_gen_cat_sidebar",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),
 
		array("type" => "close"),

array(	"name" => "Review Category Settings",
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $shortname."_review_category_settings"),
      	
        array(
		"name" => "Review Category Singular Name",
        "desc" => "The singular name for your review categories. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_cat_singluar_name",
        "std" => "Review Category",
        "type" => "text"),

        array(
		"name" => "Review Category Plural Name",
        "desc" => "The plural name for your review categories. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_cat_plural_name",
        "std" => "Review Category",
        "type" => "text"),
        
        array(
		"name" => "Review Category Slug",
        "desc" => "The slug used in review category URLs. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_cat_slug",
        "std" => "reviews",
        "type" => "text"),
        
		array("type" => "divider"),

		array(  
		"name" => "Review Category Display",
        "desc" => "Choose how to display your reviews in categories.",
        "id" => $shortname."_review_cat_display",
        "std" => "List",
		"options" => array('List', 'Compact Boxes', 'Extended Boxes'),
        "type" => "select"),

		array("type" => "divider"), 

		array(  
		"name" => "Review Category Sidebar",
        "desc" => "Choose whether to display the sidebar on review categories.",
        "id" => $shortname."_review_cat_sidebar",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),		
        
		array("type" => "close"),
		
array(	"name" => "Review Page Settings",
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $shortname."_review_page_settings"),

        array(
		"name" => "Review Post Singular Name",
        "desc" => "The singular name for your reviews. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_singular_name",
        "std" => "Review",
        "type" => "text"),

        array(
		"name" => "Review Post Plural Name",
        "desc" => "The plural name for your reviews. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_plural_name",
        "std" => "Reviews",
        "type" => "text"),
        
        array(
		"name" => "Review Post Slug",
        "desc" => "The slug used in review post URLs. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_slug",
        "std" => "review",
        "type" => "text"),
        
		array("type" => "divider"),

		array(  
		"name" => "Enable Review Tag 1",
        "desc" => "",
        "id" => $shortname."_review_tag_1",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

        array(
		"name" => "Review Tag 1 Singular Name",
        "desc" => "The singular name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_1_singular_name",
        "std" => "Release Date",
        "type" => "text"),

        array(
		"name" => "Review Tag 1 Plural Name",
        "desc" => "The plural name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_1_plural_name",
        "std" => "Release Dates",
        "type" => "text"),

        array(
		"name" => "Review Tag 1 Slug",
        "desc" => "The name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_1_slug",
        "std" => "release_date",
        "type" => "text"),
        
		array("type" => "divider"),

		array(  
		"name" => "Enable Review Tag 2",
        "desc" => "",
        "id" => $shortname."_review_tag_2",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

        array(
		"name" => "Review Tag 2 Singular Name",
        "desc" => "The singular name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_2_singular_name",
        "std" => "Genre",
        "type" => "text"),

        array(
		"name" => "Review Tag 2 Plural Name",
        "desc" => "The plural name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_2_plural_name",
        "std" => "Genres",
        "type" => "text"),

        array(
		"name" => "Review Tag 2 Slug",
        "desc" => "The name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_2_slug",
        "std" => "genre",
        "type" => "text"),
        
		array("type" => "divider"),

		array(  
		"name" => "Enable Review Tag 3",
        "desc" => "",
        "id" => $shortname."_review_tag_3",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

        array(
		"name" => "Review Tag 3 Singular Name",
        "desc" => "The singular name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_3_singular_name",
        "std" => "Rating",
        "type" => "text"),

        array(
		"name" => "Review Tag 3 Plural Name",
        "desc" => "The plural name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_3_plural_name",
        "std" => "Ratings",
        "type" => "text"),

        array(
		"name" => "Review Tag 3 Slug",
        "desc" => "The name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_3_slug",
        "std" => "rating",
        "type" => "text"),
        
		array("type" => "divider"),

		array(  
		"name" => "Enable Review Tag 4",
        "desc" => "",
        "id" => $shortname."_review_tag_4",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

        array(
		"name" => "Review Tag 4 Singular Name",
        "desc" => "The singular name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_4_singular_name",
        "std" => "Director",
        "type" => "text"),

        array(
		"name" => "Review Tag 4 Plural Name",
        "desc" => "The plural name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_4_plural_name",
        "std" => "Directors",
        "type" => "text"),

        array(
		"name" => "Review Tag 4 Slug",
        "desc" => "The slug used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_4_slug",
        "std" => "director",
        "type" => "text"),
        
		array("type" => "divider"),

		array(  
		"name" => "Enable Review Tag 5",
        "desc" => "",
        "id" => $shortname."_review_tag_5",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

        array(
		"name" => "Review Tag 5 Singular Name",
        "desc" => "The singular name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_5_singular_name",
        "std" => "Producer",
        "type" => "text"),

        array(
		"name" => "Review Tag 5 Plural Name",
        "desc" => "The plural name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_5_plural_name",
        "std" => "Producers",
        "type" => "text"),
        
        array(
		"name" => "Review Tag 5 Slug",
        "desc" => "The slug used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_5_slug",
        "std" => "producers",
        "type" => "text"),
        
		array("type" => "divider"),
		
		array(  
		"name" => "Enable Review Tag 6",
        "desc" => "",
        "id" => $shortname."_review_tag_6",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

        array(
		"name" => "Review Tag 6 Singular Name",
        "desc" => "The singular name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_6_singular_name",
        "std" => "Screenwriter",
        "type" => "text"),

        array(
		"name" => "Review Tag 6 Plural Name",
        "desc" => "The plural name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_6_plural_name",
        "std" => "Screenwriters",
        "type" => "text"),

        array(
		"name" => "Review Tag 6 Slug",
        "desc" => "The slug used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_6_slug",
        "std" => "screenwriter",
        "type" => "text"),
        
		array("type" => "divider"),

		array(  
		"name" => "Enable Review Tag 7",
        "desc" => "",
        "id" => $shortname."_review_tag_7",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

        array(
		"name" => "Review Tag 7 Singular Name",
        "desc" => "The singular name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_7_singular_name",
        "std" => "Studio",
        "type" => "text"),

        array(
		"name" => "Review Tag 7 Plural Name",
        "desc" => "The plural name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_7_plural_name",
        "std" => "Studios",
        "type" => "text"),

        array(
		"name" => "Review Tag 7 Slug",
        "desc" => "The slug used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_7_slug",
        "std" => "studio",
        "type" => "text"),
        
		array("type" => "divider"),		
				
		array(  
		"name" => "Enable Review Tag 8",
        "desc" => "",
        "id" => $shortname."_review_tag_8",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

        array(
		"name" => "Review Tag 8 Singular Name",
        "desc" => "The singular name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_8_singular_name",
        "std" => "Starring",
        "type" => "text"),

        array(
		"name" => "Review Tag 8 Plural Name",
        "desc" => "The plural name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_8_plural_name",
        "std" => "Starring",
        "type" => "text"),

        array(
		"name" => "Review Tag 8 Slug",
        "desc" => "The slug used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_8_slug",
        "std" => "starring",
        "type" => "text"),
        
		array("type" => "divider"),
		
		array(  
		"name" => "Enable Review Tag 9",
        "desc" => "",
        "id" => $shortname."_review_tag_9",
        "std" => "Enable",
		"options" => array('Disable', 'Enable'),
        "type" => "radio"),

        array(
		"name" => "Review Tag 9 Singular Name",
        "desc" => "The singular name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_9_singular_name",
        "std" => "",
        "type" => "text"),

        array(
		"name" => "Review Tag 9 Plural Name",
        "desc" => "The plural name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_9_plural_name",
        "std" => "",
        "type" => "text"),

        array(
		"name" => "Review Tag 9 Slug",
        "desc" => "The slug used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_9_slug",
        "std" => "",
        "type" => "text"),
        
		array("type" => "divider"),
		
		array(  
		"name" => "Enable Review Tag 10",
        "desc" => "",
        "id" => $shortname."_review_tag_10",
        "std" => "Enable",
		"options" => array('Disable', 'Enable'),
        "type" => "radio"),

        array(
		"name" => "Review Tag 10 Singular Name",
        "desc" => "The singular name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_10_singular_name",
        "std" => "",
        "type" => "text"),

        array(
		"name" => "Review Tag 10 Plural Name",
        "desc" => "The plural name used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_10_plural_name",
        "std" => "",
        "type" => "text"),

        array(
		"name" => "Review Tag 10 Slug",
        "desc" => "The slug used for this review tag. <strong>After saving this page, go to <em>Settings -> Permalinks</em> and resave the page twice.</strong>",
        "id" => $shortname."_review_tag_10_slug",
        "std" => "",
        "type" => "text"),

		array("type" => "divider"),
		
		array(  
		"name" => "Review Page Layout",
        "desc" => "Choose the layout for your review pages.",
        "id" => $shortname."_review_page_layout",
        "std" => "Layout",
		"options" => array('Layout 1', 'Layout 2'),
        "type" => "select"),

		array(  
		"name" => "Review Text Position",
        "desc" => "Choose where the review text is displayed.",
        "id" => $shortname."_review_text_position",
        "std" => "Within Review Tabs",
		"options" => array('Within Review Tabs', 'Below Review Tags'),
        "type" => "select"),
        
		array("type" => "divider"),
		
		array(  
		"name" => "\"Our Rating\" Type",
        "desc" => "Choose what type of rating to use. If you choose \"Multi Set Rating\" you will need to create your Multi Set template <a href=\"admin.php?page=gd-star-rating-multi-sets\">here</a> and then add the ID to the individual review page.",
        "id" => $shortname."_our_rating_type",
        "std" => "Single Rating",
		"options" => array('Single Rating', 'Multi Set Rating'),
        "type" => "radio"),

		array(  
		"name" => "\"Your Rating\" Type",
        "desc" => "Choose what type of rating to use. If you choose \"Multi Set Rating\" you will need to create your Multi Set template <a href=\"admin.php?page=gd-star-rating-multi-sets\">here</a> and then add the ID to the individual review page.",
        "id" => $shortname."_your_rating_type",
        "std" => "Single Rating",
		"options" => array('Single Rating', 'Multi Set Rating'),
        "type" => "radio"),

		array("type" => "divider"), 
		
		array(  
		"name" => "Review Meta Data",
        "desc" => "Choose whether to display the author name and review date on review posts.",
        "id" => $shortname."_review_meta",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),
        
		array("type" => "close"),
		
array(	"name" => "Slider Settings",
		"type" => "title"),
        
		array(	"type" => "open",
      	"id" => $shortname."_slider_settings"),
      	
        array(
		"name" => "Slider Category",
        "desc" => "Select a <a href=\"../wp-admin/edit-tags.php?taxonomy=slide_categories&post_type=slide\">slider category</a> to display in your slider.",
        "id" => $shortname."_slider_cat",
        "std" => "",
        "type" => "taxonomy_select"),

		array("type" => "divider"), 
		
		array(  
		"name" => "Slider Display",
        "desc" => "Choose where to display the slider.",
        "id" => $shortname."_slider_display",
        "std" => "Homepage",
		"options" => array('Homepage', 'All Pages', 'Disable'),
        "type" => "select"),

		array(  
		"name" => "Include On Specific Posts",
        "desc" => "Enter the IDs of the posts you want the slider to appear on, separating each with a comma (e.g. 23,51,102,65)",
        "id" => $shortname."_slider_posts",
        "type" => "text"),
        
        array(  
		"name" => "Include On Specific Pages",
        "desc" => "Enter the IDs of the pages you want the slider to appear on, separating each with a comma (e.g. 23,51,102,65)",
        "id" => $shortname."_slider_pages",
        "type" => "text"),
 
 		array("type" => "divider"), 
 		
		array(  
		"name" => "Slider Auto Rotation",
        "desc" => "",
        "id" => $shortname."_slider_auto_rotation",
        "std" => "Enable",
		"options" => array('Enable', 'Disable'),
        "type" => "radio"),

		array("type" => "divider"), 
		
 		array(  
		"name" => "Slider Effect",
        "desc" => "",
        "id" => $shortname."_slider_effect",
        "std" => "Random",
		"options" => array('Random', 'Slice Down', 'Slice Down Left', 'Slice Up', 'Slice Up Left', 'Slice Up Down', 'Slice Up Down Left', 'Fold', 'Fade'),
        "type" => "select"),

		array("type" => "divider"), 
		
        array(
		"name" => "Slider Transition Speed",
        "desc" => "The number of seconds between each slide transition.",
        "id" => $shortname."_slider_transition_speed",
        "std" => "3000",
        "type" => "text"),

		array("type" => "divider"), 
		
        array(
		"name" => "Slider Animation Speed",
        "desc" => "The speed of the slider slicing animation effect.",
        "id" => $shortname."_slider_animation_speed",
        "std" => "500",
        "type" => "text"),

		array("type" => "divider"), 
		
        array(
		"name" => "Slider Slices",
        "desc" => "The number of slices in the slider animations.",
        "id" => $shortname."_slider_slices",
        "std" => "20",
        "type" => "text"),
        
		array("type" => "close"),

array(	"name" => "Font Settings",
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $shortname."_font_settings"),
  		
		array(  
		"name" => "Cufon Fonts",
        "desc" => "Check fonts to enable.",
        "id" => $shortname."_cufon_fonts",
        "type" => "header"),
        
		array(  
		"name" => "",
        "desc" => "<span class=\"chunkfive\">Chunk Five</span>",
        "id" => $shortname."_chunkfive",
        "extras" => "multi",
        "type" => "checkbox"),

		array(
        "desc" => "<span class=\"journal\">Journal</span>",
        "id" => $shortname."_journal",
        "extras" => "multi",
        "type" => "checkbox"),
        
		array(
        "desc" => "<span class=\"leaguegothic\">League Gothic</span>",
        "id" => $shortname."_leaguegothic",
        "extras" => "multi",
        "type" => "checkbox"),

		array(
        "desc" => "<span class=\"quicksand\">Quicksand</span>",
        "id" => $shortname."_quicksand",
        "extras" => "multi",
        "type" => "checkbox"),

		array(
        "desc" => "<span class=\"sansation\">Sansation</span>",
        "id" => $shortname."_sansation",
        "extras" => "multi",
        "type" => "checkbox"),
        
		array(
        "desc" => "<span class=\"vegur\">Vegur</span>",
        "id" => $shortname."_vegur",
        "extras" => "multi",
        "type" => "checkbox"),
 
 		array("type" => "divider"),
 		
		array(
		"name" => "Cufon Replacement Code",
        "desc" => "If you want to add cufon to other text or use more than one cufon font e.g. <code>Cufon.replace(\"h1,h2,h3,h4,h5,h6\", {fontFamily: \"Vegur\"});</code><br/><code>Cufon.replace(\"#logo-text\", {fontFamily: \"Sansation\"});</code>",
        "id" => $shortname."_cufon_code",
        "std" => "",
        "type" => "textarea"),

		array("type" => "close"),
		
array(	"name" => "CSS Settings",
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $shortname."_css_settings"),

		array(
		"name" => "Custom CSS",
        "desc" => "If you want to modify the theme style in some way add your own code here instead of editing the style sheets. <em>Note: You may have to add !important to your tags in some cases so it overwrites the default settings e.g. body {background: #000000 !important;}.</em>",
        "id" => $shortname."_custom_css",
        "std" => "",
        "height" => "yes",        
        "type" => "textarea"),
        
		array("type" => "close"),
		
array(	"name" => "Import/Export Settings",
		"type" => "title"),

		array(	"type" => "open",
      	"id" => $shortname."_importexport_settings"),
      	
		array(  
		"name" => "Export",
        "id" => $shortname."_import_export",
        "type" => "import_export"),
        
		array("type" => "close"),
	
);

function mytheme_add_admin() {

    global $themename, $dirname, $shortname, $options;

			
    if ( $_GET['page'] == basename(__FILE__) ) {

        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=theme-options.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=theme-options.php&reset=true");
            die;

        }

		else if( 'export' == $_REQUEST['action'] ) export_settings();
		else if( 'import' == $_REQUEST['action'] ) import_settings();

    }

    add_theme_page("Theme Options", "Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $dirname, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated"><p><strong>Options Saved</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated"><p><strong>Options Reset</strong></p></div>';

?>

		
<?php
echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/lib/admin/css/admin.css" type="text/css" media="screen" />
<script type="text/javascript" src="'.get_bloginfo('template_url').'/lib/admin/js/jquery.tabs.js"></script>
<script type="text/javascript" src="'.get_bloginfo('template_url').'/lib/admin/js/jquery.color.picker.js"></script>
<script type="text/javascript" src="'.get_bloginfo('stylesheet_directory').'/js/cufon-yui.js"></script>
<script src="'.get_bloginfo('stylesheet_directory').'/js/fonts/League_Gothic_400.font.js"></script>
<script type="text/javascript" src="'.get_bloginfo('stylesheet_directory').'/js/fonts/Quicksand_Book_400-Quicksand_Bold_700-Quicksand_Book_Oblique_oblique_400-Quicksand_Bold_Oblique_oblique_700.font.js"></script>
<script type="text/javascript" src="'.get_bloginfo('stylesheet_directory').'/js/fonts/Journal_400.font.js"></script>
<script type="text/javascript" src="'.get_bloginfo('stylesheet_directory').'/js/fonts/Vegur_400-Vegur_700-Vegur_300.font.js"></script>
<script type="text/javascript" src="'.get_bloginfo('stylesheet_directory').'/js/fonts/ChunkFive_400.font.js"></script>	
<script type="text/javascript" src="'.get_bloginfo('stylesheet_directory').'/js/fonts/Sansation_400-Sansation_700.font.js"></script>
<script type="text/javascript">
Cufon.replace(".chunkfive", {fontFamily: "ChunkFive"});
Cufon.replace(".journal", {fontFamily: "Journal"});
Cufon.replace(".leaguegothic", {fontFamily: "League Gothic"});
Cufon.replace(".quicksand", {fontFamily: "Quicksand Book"});
Cufon.replace(".sansation", {fontFamily: "Sansation"});
Cufon.replace(".vegur", {fontFamily: "Vegur"});
</script>
';
?>

<div id="theme-options-container" class="wrap">
	
<?php screen_icon('options-general'); ?>
<h2>Theme Options</h2>

<ul id="theme-option-links">
	<li><a href="http://www.ghostpool.com/help/<?php echo $dirname; ?>/changelog.html" target="_blank">Changelog/Updates</a></li>
	<li><a href="http://www.ghostpool.com/help/<?php echo $dirname; ?>/help.html" target="_blank">Help File</a></li>
	<li><a href="http://www.themeforest.net/user/GhostPool/portfolio?ref=GhostPool" target="_blank">More Themes</a></li>
</ul>

<form method="post">
	
<div class="theme-buttons-top submit">	
	<input name="save" type="submit" value="Save changes" />
	<input type="hidden" name="action" value="save" />
</div>

<div class="clear"></div>

<div id="panels">

<?php foreach ($options as $value) {
switch ( $value['type'] ) {
case "open":
?>

<?php break;
case "close":
?>

</div>

<?php break;
case "title":
?>

	<div class="panel option-tab" title="<?php echo $value['name']; ?>">

<?php break;
case "header":
?>

	<div class="option option-header">
		<h3><?php echo $value['name']; ?></h3>
		<div class="option-desc"><?php echo $value['desc']; ?></div>
	</div>

<?php break;
case "divider":
?>

<div class="divider"></div>

<?php break;
case 'text':
?>
	
	<div class="option">
		<h3><?php echo $value['name']; ?></h3>
		<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" class="theme-input" />
		<?php if($value['extras'] == "uploadbutton") { ?><a href="media-upload.php?post_id=&amp;type=image&amp;TB_iframe=true&amp;width=640&amp;height=500" id="add_image" class="thickbox button" title='Add an Image' onclick="return false;">Get Image</a><?php } ?>
		<div class="option-desc"><?php echo $value['desc']; ?></div>
	</div>

<?php break;
case 'text_small':
?>

	<div class="option">
		<h3><?php echo $value['name']; ?></h3>
		<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" class="theme-input text-small" />
		<div class="option-desc"><?php echo $value['desc']; ?></div>
	</div>

<?php break;
case 'dimension':
?>
	
	<div class="option dimensions">
		<h3><?php echo $value['name']; ?></h3>
		<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" class="theme-input" /><span>px</span>
		<div class="option-desc"><?php echo $value['desc']; ?></div>
	</div>

<?php
break;

case 'textarea':
?>

	<div class="option">
		<h3><?php echo $value['name']; ?></h3>
		<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows="" class="theme-textarea<?php if($value['height'] == "yes") { ?> large-textarea<?php } ?>"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?></textarea>
		<div class="option-desc"><?php echo $value['desc']; ?></div>
	</div>

<?php
break;
case 'select':
?>
	
	<div class="option">
		<h3><?php echo $value['name']; ?></h3>
		<select class="theme-select" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option value="<?php echo $option; ?>" <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select>
		<div class="option-desc"><?php echo $value['desc']; ?></div>
	</div>


<?php
break;
case 'taxonomy_select':
?>
	
	<div class="option">
		<h3><?php echo $value['name']; ?></h3>
		<?php $terms = get_terms('slide_categories', 'hide_empty=0'); ?>
		<select class="theme-select" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><option value=''>None</option><?php foreach ($terms as $term): ?><option value="<?php echo $term->slug; ?>" <?php if ( get_option( $value['id'] ) ==  $term->slug) { echo ' selected="selected"'; } ?>><?php echo $term->name; ?></option><?php endforeach; ?></select>
		<div class="option-desc"><?php echo $value['desc']; ?></div>
	</div>	
	
<?php
break;
case "checkbox":
?>
   
<div class="option <?php if($value['extras'] == "multi") { ?>multi-checkbox<?php } ?>">
	<h3><?php echo $value['name']; ?></h3>
	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?><input class="theme-checkbox" type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<div class="theme-checkbox-desc"><?php echo $value['desc']; ?></div>
</div>

<?php        
break;
case "radio":
?>

	<div class="option">
		<h3><?php echo $value['name']; ?></h3>	
		<?php foreach ($value['options'] as $key=>$option) {
		$radio_setting = get_option($value['id']);
		if($radio_setting != ''){
			if ($key == get_option($value['id']) ) {
				$checked = "checked=\"checked\"";
				} else {
					$checked = "";
				}
		}else{
			if($key == $value['std']){
				$checked = "checked=\"checked\"";
			}else{
				$checked = "";
			}
		}?>
			<div class="theme-radio-wrapper">
			<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id'] . $key; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><label for="<?php echo $value['id'] . $key; ?>"><?php echo $option; ?></label>
			</div>	
		<?php } ?>
		<div class="option-desc"><?php echo $value['desc']; ?></div>
	</div>

<?php        
break;
case "colorpicker":
?>

  <div class="option option-colorpicker">
    <h3><?php echo $value['name']; ?></h3>
    <div class="section">
      <div class="element">
        <script type="text/javascript">
        jQuery(document).ready(function($) {  
          $("#<?php echo $value['id']; ?>").ColorPicker({
            onSubmit: function(hsb, hex, rgb) {
            	$("#<?php echo $value['id']; ?>").val("#"+hex);
            },
            onBeforeShow: function () {
            	$(this).ColorPickerSetColor(this.value);
            	return false;
            },
            onChange: function (hsb, hex, rgb) {
            	$("#cp_<?php echo $value['id']; ?> div").css({"backgroundColor":"#"+hex, "backgroundImage": "none", "borderColor":"#"+hex});
            	$("#cp_<?php echo $value['id']; ?>").prev("input").attr("value", "#"+hex);
            }
          })	
          .bind('keyup', function(){
            $(this).ColorPickerSetColor(this.value);
          });
        });
        </script>
        <input type="text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" class="cp_input" />
        <div id="cp_<?php echo $value['id']; ?>" class="cp_box">
          <div style="background-color:<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo '#fff'; } ?>;<?php if ( get_option( $value['id'] ) != "") { echo 'background-image:none; border-color:' . get_option($value['id']) . ';'; } ?>"> 
          </div>
        </div> 
      </div>
      <div class="clear"></div>
      <div class="option-desc">Click the text box for color picker.</div>
    </div>
  </div>


<?php        
break;
case "import_export":
?>

	</form>

	<div class="option submit">
	
		<h3>Import Theme Settings</h3>
		<div class="option-desc">If you have a back up of your theme settings you can import them below.</div>
		
		<form method="post" enctype="multipart/form-data">
		<p><input type="file" name="file" id="file" />
		<input type="submit" name="import" value="Upload" /></p>
		<input type="hidden" name="action" value="import" />
		</form>
	
	</div>
	
	<div class="divider"></div>
	
	<div class="option submit">
	
		<h3>Export Theme Settings</h3>
		<div class="option-desc">If you want to create a back up of all your theme settings click the Export button below. <em>Note: This option only backs up your theme settings and not your post/page data.</em></div>
		
		<form method="post">
		<p><input name="export" type="submit" value="Export Theme Settings" /></p>
		<input type="hidden" name="action" value="export" />
		</form>	
	
	</div>

<?php        
break;
}}
?>

</div>

<div class="clear"></div>

<div class="theme-buttons-bottom submit">
	
	<form method="post" onSubmit="if(confirm('Are you sure you want to reset all the theme settings?')) return true; else return false;">
	<input name="reset" type="submit" value="Reset" />
	<input type="hidden" name="action" value="reset" />
	</form>

</div>

<div class="clear"></div>

<?php } 

if (function_exists('wp_enqueue_style')) {
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');		
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
}

add_action('admin_menu', 'mytheme_add_admin'); 

// Export Theme Settings
function export_settings() {
	global $options;
	header("Cache-Control: public, must-revalidate");
	header("Pragma: hack");
	header("Content-Type: text/plain");
	header('Content-Disposition: attachment; filename="theme-options-'.date("dMy").'.dat"');
	foreach ($options as $value) $theme_settings[$value['id']] = get_option( $value['id'] );	
	echo serialize($theme_settings);
}

// Import Theme Settings
function import_settings() {
	global $options;
	if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br />";
	} else {
		$rawdata = file_get_contents($_FILES["file"]["tmp_name"]);		
		$theme_settings = unserialize($rawdata);		
		foreach ($options as $value) {
			if ($theme_settings[$value['id']]) {
				update_option( $value['id'], $theme_settings[$value['id']] );
				$$value['id'] = $theme_settings[$value['id']];
			} else {
				if ($value['type'] == 'checkbox_multiple') $$value['id'] = array();
				else $$value['id'] = $value['std'];
			}
		}
		
	}
	if (in_array('cacheStyles', get_option('theme_misc'))) cache_settings();
	wp_redirect($_SERVER['PHP_SELF'].'?page=theme-options.php');
}

?>