    <div id="footer">
        <div id="copyright">
            <a href="http://www.kaydoo.co.uk/projects/backendpro">BackendPro</a> &copy; Copyright 2008 - <a href="http://www.kaydoo.co.uk">Adam Price</a> -  All rights Reserved
        </div>
        <div id="version">
            <a href="#top"><?php print $this->lang->line('general_top')?></a> |
            <a href="<?php print base_url()?>user_guide"><?php print $this->lang->line('general_documentation')?></a> |
            Version <?php print BEP_VERSION?></div>
    </div>
</div>
<?php print $this->bep_assets->get_footer_assets();?>
<script src="<?=base_url();?>js/jquery.elastic.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
			// <![CDATA[
			$(document).ready(function(){			
				$('textarea').elastic();
			});	
			// ]]>
</script>

</body>
</html>