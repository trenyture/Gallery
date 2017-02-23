# Simple Photo/Video Gallery
A simple PHP Photo / Video Gallery without any database, only pure FTP.

# Author
Simon Trichereau <br/>
[website](http//simon-tr.com)

# Installation instructions
## With GIT
In your Command Line Editor, use : ``` git clone https://github.com/trenyture/galery.git ```
## Downloading the Zip
Click on _Clone or Download_ button then on _Download ZIP_

# Configuration instructions
1. In your directory install the project (Dezip or Cloning).
2. In the **index.php** file change the ``` base ``` tag with your url
	* ``` <base href="http://www.my-site.com/"> ```
	* or ``` <base href="http://www.my-site.com/path/to/folder"> ```
3. Upload your files in the **storage** folder
4. You could upload the same files in the **miniatures** folder to make it load more quickly
3. Enjoy

#Explaination
The Files (Images and Video only) are send to Storage where you can create folders and subfolders to organize your files.
The php engine will read all your architecture and display it in the Index.php! 
The routes are made on the same way than my personal Router, **DO NOT REMOVE** .htaccess file!

#Future Specs
	* An administration to upload / remove / modify the files.
	* A theme section to Customize the Gallery!

# Architecture
	| - .htaccess
	| - index.php
	| - README.md	
	| ---- assets
		| ---- css
			| - main.css
		| ---- img
			| - fold_placeholder.png
			| - img_placeholder.png
			| - vid_placeholder.png
		| ---- js
			| - main.js
		| ---- php
			| - main.php
	| ---- miniatures
	| ---- storage

# Copyright
**© Simon Trichereau - 2016** <br/>
_This project is totally free for commercial or personnal use and modifications are welcome on the Branch Development!_

# Contact information
To contact me you can send me a message to : [simon.trichereau@gmail.com](mailto:simon.trichereau@gmail.com)
