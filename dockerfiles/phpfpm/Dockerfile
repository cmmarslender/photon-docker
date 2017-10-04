FROM johnpbloch/phpfpm:7.0

RUN apt-get update && apt-get install -y \
		webp \
		jpegoptim \
		optipng \
		pngquant \
		graphicsmagick \
		subversion \
		libgraphicsmagick1-dev && \
		pecl install gmagick-2.0.4RC1 && \
		echo "extension=gmagick.so" >> /usr/local/etc/php/conf.d/docker-php-ext-gmagick.ini

RUN ln -s /usr/bin/cwebp /usr/local/bin/cweb && \
	ln -s /usr/bin/jpegoptim /usr/local/bin/jpegoptim && \
	ln -s /usr/bin/optipng /usr/local/bin/optipng && \
	ln -s /usr/bin/pngquant /usr/local/bin/pngquant

RUN svn co https://code.svn.wordpress.org/photon/ /var/www/html/

COPY ./config.php /var/www/html/config.php

RUN rm -rf /var/www/html/.svn && \
	apt-get remove -y subversion && \
	apt-get autoremove -y && \
	apt-get clean

CMD ["php-fpm"]

EXPOSE 9000
