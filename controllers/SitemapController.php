<?php
namespace Controllers;

use MVC\Router;


class SitemapController {
    public static function index(Router $router)
    {
        
        // Lógica para generar el contenido del sitemap
        
        $sitemapContent = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        
          <url>
            <loc>https://tiendaatlanticcr.com/</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
          
            <loc>https://tiendaatlanticcr.com/products</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        
            <loc>https://tiendaatlanticcr.com/products-aurum</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        
            <loc></loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        
            <loc>https://tiendaatlanticcr.com/about</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        
            <loc>https://tiendaatlanticcr.com/reviews</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
            
            <loc>https://tiendaatlanticcr.com/contact</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        
            <loc>https://tiendaatlanticcr.com/cart</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0</priority>
          </url>
        </urlset>
        ';
        // Configura las cabeceras para indicar que es XML
        header('Content-Type: application/xml');

        // Imprime el contenido del sitemap
        echo $sitemapContent;
        
    }

    public static function generateSitemap()
    {
        // Lógica para generar el contenido del sitemap
        // Puedes usar una librería o construir manualmente el XML

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        
          <url>
            <loc>https://tiendaatlanticcr.com/</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
          </url>
          <url>
            <loc>https://tiendaatlanticcr.com/products</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        
            <loc>https://tiendaatlanticcr.com/products-aurum</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        
            <loc></loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        
            <loc>https://tiendaatlanticcr.com/about</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        
            <loc>https://tiendaatlanticcr.com/reviews</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
            
            <loc>https://tiendaatlanticcr.com/contact</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        
            <loc>https://tiendaatlanticcr.com/cart</loc>
            <lastmod>2024-01-20</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0</priority>
          </url>
        </urlset>
        ';

        return $xml;
    }
}