# Setup Blog using Dropplets on Azure Websites
- Gummadi
- Gummadi
- 2014-12-12
- Dropplets, Blogging, Azure Websites
- pubished

## Requirements ##

I have looked at various ways of setting up a blog, here are my list of requirements:

- Self hosted on my domain
- Markdown support
- Open source (so that I customize or fix any issues)

[Dropplets](http://dropplets.com/) fit these requirements to the T. Its a simple PHP based blogging framework which supports Markdown. Its also actively maintained on [github](https://github.com/Circa75/dropplets). 

## Setup ##

The local setup is extremely simple, you just need to download the latest zip file available [Dropplets](http://dropplets.com/) homepage. The following screenshot gives you an idea on what each directory means

1. **Posts**: Contains all your posts in the markdown format
2. **Plugins**: Contains the templates which are installed
3. **index.php**: The entry point for your site. You can modify or add custom code in this file, for example: Google analytics tags etc.
4. **Cache/Dropplets/Plugins**: These contain the core Dropplets source (mostly Php helper functions). Also if you are checking in this directory to source control, exclude `cache`, since it is dynamically populated 

![Dropplets Directory](http://googledrive.com/host/0B-_fDRYNhz_Rdi1VSnVIN01WbUk/dropplets_directory.png)

Once you have extracted the zip file, based on the OS you need to copy to different directories 

* **MacOS/Linux**:[ Setup a Apache server](https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-14-04-lts) and copy the extracted files to `/var/www` directory.
* **Windows**: [Set up IIS on Windows](http://support.microsoft.com/kb/323972), create a website and copy the contents of the folder to that site.
	* In addition to creating the site, you also need to create a `web.config` for IIS to recognize this site. Here is mine:

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

Once you set this up, you should be successfully able to access the site from your local machine without any additional configuration. 

## Hosting using Azure ##

Once you have the above setup running successfully on your local machine, you can get it up and running on any shared hosting site by [uploading those files](http://webdesign.tutsplus.com/articles/how-to-get-dropplets-cms-up-and-running--cms-19835). In my case, I want to set this site up using [Azure Website](http://azure.microsoft.com/en-us/services/websites/) (Azure's PAAS offering), so that I need not worry about future scaling or OS upgrades. There is a lot of information available on how to get started using Azure Websites, here is one by [Scott Hanselman](http://www.hanselman.com/blog/PennyPinchingInTheCloudWhenDoAzureWebsitesMakeSense.aspx). The blog also clearly explains what are the advantages of using Azure Websites versus other options.   

Once you create your Microsoft Azure account and created a website, you have two options on how to maintain your Dropplets Blog

1. FTP Upload
2. Git (Github)

The following screenshot shows where to start for each of the option on your website dashboard.

![Dashboard Setup](http://googledrive.com/host/0B-_fDRYNhz_Rdi1VSnVIN01WbUk/dashboardsetup.png)

### FTP Upload ###

This is a standard process, if you have any prior FTP experience

* Download a FTP client like [Filezilla](https://filezilla-project.org/)
* Connect to your Azure host (Get the host and login details from the dashboard)
* Login and copy the directory under `site/wwwroot` (Refer to screenshot below)  

![FTP Filezilla](http://googledrive.com/host/0B-_fDRYNhz_Rdi1VSnVIN01WbUk/ftpfilezilla.png)

### Github ###

I use the **Github** option for the following reasons:

* Maintain my blog posts under version control
* Merge upstream changes from original [Dropplets repo](https://github.com/circa75/dropplets) so that I can stay on bleeding edge
* Azure deploys your site when you do `git push` to your `master`, which makes the publishing part really easy. 

Once you click the *Connect your github repository* on your website's dashboard, Azure guides you on how to hook up your existing repository to this website. If you face any issues doing that, refer to this [article](http://azure.microsoft.com/en-us/documentation/articles/web-sites-publish-source-control/#Step7).

Once you set this up, every time you do a `git push` to your `master`, your blog is automatically published. You can monitor your deployments from the `deployments` tab on your Azure website. Here is my screenshot:

![Azure Deployments](http://googledrive.com/host/0B-_fDRYNhz_Rdi1VSnVIN01WbUk/azure_deployments.png)

### Custom Domain on Azure ###

If you do have a custom domain and want to point to your Azure website, select the configure tab and scroll down to *domain names* section. There you can add your custom domain by clicking *manage domains*

![Azure Deployments](http://googledrive.com/host/0B-_fDRYNhz_Rdi1VSnVIN01WbUk/domain_name.png)


## Conclusion ##

I am pretty happy with how easy it is setup your blog using Dropplets. I would highly recommend this CMS, if you are a big fan of Markdown and want to host your own blog. If you have any feedback or want to share your experiences setting up Dropplets, feel free to reach out to me.  
