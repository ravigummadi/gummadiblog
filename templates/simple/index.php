<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        
        <title><?php echo($page_title); ?></title>
        
        <?php echo($page_meta); ?>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="<?php echo($template_dir_url); ?>style.css">
        <link rel="stylesheet" href="<?php echo($template_dir_url); ?>subdiv.css">
        <link href='//fonts.googleapis.com/css?family=Merriweather:400,300,700' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/default.min.css">        
        <?php get_header(); ?>
    </head>

    <body>
        <?php if($is_home) { ?>
        <article>
            <div class="row">
                <div class="one-quarter meta">
                    <div class="thumbnail">
                        <img src="<?php echo get_twitter_profile_img($blog_twitter); ?>" alt="profile" />
                    </div>
        
                    <ul>
                        <li><?php echo($blog_title); ?></li>
                        <li><a href="mailto:<?php echo($blog_email); ?>?subject=Hello Ravi [via Blog]"><?php echo($blog_email); ?></a></li>
                        <li><a href="http://twitter.com/<?php echo($blog_twitter); ?>">&#64;<?php echo($blog_twitter); ?></a></li>
						<li><a href="<?php echo($resume_url); ?>">Resume</a></li>
						<li></li>                        
                    </ul>
                </div>
        
                <div class="three-quarters post">
                    <h2><?php echo($intro_title); ?></h2>
        
                    <p><?php echo($intro_text); ?></p>								
					
					<p><i><?php echo($disclaimer); ?></i></p>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
            </div>
        </article>
        <?php } ?>
        
        <?php echo($content); ?>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
        <?php get_footer(); ?>
    </body>
</html>
