<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<input type="text" name="s" id="searchbar" value="<?php echo gp_search_form; ?>" onblur="if (this.value == '') {this.value = '<?php echo gp_search_form; ?>';}" onfocus="if (this.value == '<?php echo gp_search_form; ?>') {this.value = '';}"  /><input type="submit" id="searchsubmit" value="" /></form>