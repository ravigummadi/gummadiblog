# Setting up Blog using Dropplets on Azure Websites
- Gummadi
- Gummadi
- 2014-12-15
- Dropplets, Blogging, Azure Websites
- published

I have looked at various ways of setting up my blog with the following requirements:

- Simple and [responsive design](http://en.wikipedia.org/wiki/Responsive_web_design)
- Self hosted on my domain
- [Markdown](http://daringfireball.net/projects/markdown/syntax) support
- Open source

[Dropplets](http://dropplets.com/) fits all these requirements. Its a simple PHP based blogging framework which supports Markdown. Its also actively maintained on [github](https://github.com/Circa75/dropplets). 

## Setup ##

The local setup is very simple, you need to download the latest zip file available on [Dropplets](http://dropplets.com/) homepage, extract it and copy to web root folder of your favorite web server. 

The downloaded zip file has the following directories:

1. **Posts**: Contains all your posts in the markdown format
2. **Plugins**: Contains the templates which are installed
3. **index.php**: The entry point for your site. You can modify or add custom code in this file, for example: Google Analytics tags etc.
4. **Cache/Dropplets/Plugins**: These contain the core Dropplets source (mostly PHP helper functions). Also if you are checking in this directory to source control, exclude `cache`, since it is dynamically populated 

![Dropplets Directory](http://googledrive.com/host/0B-_fDRYNhz_Rdi1VSnVIN01WbUk/dropplets_directory.png)


* **MacOS/Linux**:[ Setup a Apache server](https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-14-04-lts) and copy the extracted files to `/var/www` directory.
* **Windows**: [Set up IIS on Windows](http://support.microsoft.com/kb/323972), create a website and copy the contents of the folder to that site.
	* In addition to creating the site, you also need to create a `web.config` for IIS to recognize this site. Here is mine:
	
<pre><code class="xml">
```
	<?xml version="1.0"?>
    	<configuration>
    	<system.web>
    		<compilation debug="false" targetFramework="4.0" />
    	</system.web>
    	<system.webServer>
    		 <rewrite>
    			<rules>
    			   <rule name="Main Rule" stopProcessing="true">
    				  <match url="(.*)" />
    				  <conditions logicalGrouping="MatchAll">
    					<add input="{REQUEST_FILENAME}" matchType="IsFile" negate="true" />
    					<add input="{REQUEST_FILENAME}" matchType="IsDirectory" negate="true" />
    				  </conditions>
    				  <action type="Rewrite" url="index.php?filename={R:1}" />
    			   </rule>
    			</rules>
    		 </rewrite>
    	</system.webServer>
    	</configuration>		
```
</pre></code>

Once you set this up, you can successfully access the site from your local machine without any additional configuration. 

## Hosting using Azure ##

Once the above setup running successfully on the local machine, we can get it up and running on any shared hosting site by [uploading those files](http://webdesign.tutsplus.com/articles/how-to-get-dropplets-cms-up-and-running--cms-19835). In my case, I want to setup this site using [Azure Website](http://azure.microsoft.com/en-us/services/websites/) (Azure's PAAS - Platform As A Service offering), so that I need not worry about future scaling or OS upgrades. There is a lot of information available on how to get started using Azure Websites, here is one by [Scott Hanselman](http://www.hanselman.com/blog/PennyPinchingInTheCloudWhenDoAzureWebsitesMakeSense.aspx). The blog also clearly explains what are the advantages of using Azure Websites versus other options.   

Once you create Microsoft Azure account and created a Azure Website, you have two options to maintain your Dropplets Blog

1. FTP Upload
2. Git (Github)

The following screenshot from the website dashboard shows how to setup the blog either using FTP or Github.

![Dashboard Setup](http://googledrive.com/host/0B-_fDRYNhz_Rdi1VSnVIN01WbUk/dashboardsetup.png)

### FTP Upload ###

This is a standard process, if you have any prior FTP experience:

* Download a FTP client like [Filezilla](https://filezilla-project.org/)
* Connect to your Azure host (Get the host and login details from the dashboard)
* Login and copy `Dropplets` directory to `site/wwwroot` (Refer to screenshot below)  
* You can now access the site using your hostname (Azure website gives you a default hostname like <xyz>.azurewebsites.net)

![FTP Filezilla](http://googledrive.com/host/0B-_fDRYNhz_Rdi1VSnVIN01WbUk/ftpfilezilla.png)

### Github ###

I use the **Github** option for the following reasons:

* Maintain blog posts under version control
* Merge upstream changes from original [Dropplets repo](https://github.com/circa75/dropplets) to stay on bleeding edge
* Deploy your blog when you do a `git push` to your `master`

Once you click the *Connect your github repository* on the website's dashboard, Azure guides you on how to hook up the existing repository to the website. If you face any issues doing that, refer to this [article](http://azure.microsoft.com/en-us/documentation/articles/web-sites-publish-source-control/#Step7).

Once this is setup, every time you do a `git push` to your `master`, blog is automatically published. You can monitor your deployments from the `deployments` tab on your Azure website. Here is my screenshot:

![Azure Deployments](http://googledrive.com/host/0B-_fDRYNhz_Rdi1VSnVIN01WbUk/azure_deployments.png)

If the github repository is public, you don't want to checkin all the configurations and Dropplets admin passwords. So make sure the `.gitignore` excludes all such files. Here is my `.gitignore` file

	*.espressostorage
	*.esproj
	*.pxm
	.DS_Store
	
	.htaccess
	config.php
	verify.php
	
	templates/*
	!templates/simple/
	
	plugins/*
	!plugins/index.php
	
	!posts/index.php
	
	cache/*.png
	cache/*.jpeg
	cache/*.jpg
	 
**config.php** in your home directory has the Password for Dropplets admin panel. If you want to update or change it, you can use the FTP option described above to access it.

### Custom Domain on Azure ###

If you want your custom domain to point to the Azure Website, select the configure tab and scroll down to *domain names* section. There you can add your custom domain by clicking *manage domains*

![Azure Deployments](http://googledrive.com/host/0B-_fDRYNhz_Rdi1VSnVIN01WbUk/domain_name.png)


## Final Thoughts ##

I am pretty happy with how easy it is setup your blog using Dropplets and how polished the blog looks. I would highly recommend Dropplets, if you are a big fan of Markdown and want to host your own blog. If you have any feedback or want to share your experiences setting up Dropplets, feel free to reach out to me.  
