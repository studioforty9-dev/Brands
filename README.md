# StudioForty9 Brands

## Features

- Adds a new product attribute for brands
- Adds a new route to display products by brand
- Allows for management of brands via an admin interface

## Upcoming Features

- Multi store
- SEO data for each brand

## Installation

### Composer

Add the package to your require list, here's a sample composer file:

```json
{
  "require": {
    "studioforty9/brands": "dev-master"
  },
  "repositories": [
    { "type": "composer", "url": "http://packages.firegento.com" },
    { "type": "vcs", "url": "http://github.com/studioforty9/brands" }
  ],
  "extra":{
    "magento-root-dir": "htdocs/",
    "magento-force": true,
    "auto-append-gitignore": true,
    "magento-deploystrategy": "copy"
  }
}
```

> Don't forget to set permissions on media/brand to 0777.

## Configuration

Once you've got the extension installed, you can configure some defaults via System => Configuration => StudioForty9 => Brands.

You can choose to show/hide breadcrumbs. You can show/hide a link in the top.links block, you can also label that link whatever you want.

You can also set the SEO title, keywords and description for the brands index page.

A new menu item for Brands will be added to the top menu. You can add, edit and delete brands. A product attribute 'brand_id' will automatically be created. You can choose to show the attribute in layered navigation, search, in the product listing etc yourself.

A frontend route will be created to show products by brand.

## Contributing

[see CONTRIBUTING file](https://github.com/studioforty9/brands/blob/master/CONTRIBUTING.md)

## Licence

BSD 3 Clause [see LICENCE file](https://github.com/studioforty9/brands/blob/master/LICENCE)
