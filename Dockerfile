# Use an official PHP image as a base
FROM php:8.1-cli

# Update packages and install Python3 and pip3, then clean up apt lists to minimize image size
RUN apt-get update && apt-get install -y python3 python3-pip && rm -rf /var/lib/apt/lists/*

# Optionally, install Composer if your project requires it
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN composer install

# Set the working directory
WORKDIR /app

# Copy project files into the container
COPY . .

# Install Python dependencies using pip3
RUN pip3 install --break-system-packages -r requirements.txt

# Expose the port (Railway will provide $PORT)
EXPOSE 8000

# Start the PHP built-in server
CMD ["php", "-S", "0.0.0.0:$PORT", "-t", "."]
