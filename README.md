# Piwik ApiGetWithSitesInfo Plugin

## Description

Modifies the 'API.get' output to also list the website name and main website URL.

When calling the API method `API.get` it will be enriched with the following new fields for each website:

 * `idsite` - Website ID
 * `site_url` - Website URL
 * `site_name` - Website name

 If you specify `&idSite=all` it will decorate each website in the response with the new fields.
 
The output will look as follows:

```
<?xml version="1.0" encoding="utf-8" ?>
<result>
	<idsite>2</idsite>
	<site_url>http://blog.shacklefordvetclinic.com</site_url>
	<site_name>Shackleford Road Veterinary Clinic</site_name>
    <nb_uniq_visitors>2397</nb_uniq_visitors>
    <nb_visits>2758</nb_visits>
    <nb_actions>7943</nb_actions>
    <bounce_count>1421</bounce_count>
    <nb_conversions>987</nb_conversions>
    <nb_visits_converted>838</nb_visits_converted>
    <revenue>0</revenue>
    <nb_pageviews>6370</nb_pageviews>
    <nb_uniq_pageviews>5330</nb_uniq_pageviews>
    <nb_downloads>368</nb_downloads>
    <nb_uniq_downloads>305</nb_uniq_downloads>
    <nb_outlinks>951</nb_outlinks>
    <nb_uniq_outlinks>871</nb_uniq_outlinks>
    <nb_searches>27</nb_searches>
    <nb_keywords>25</nb_keywords>
    <nb_hits_with_time_generation>5635</nb_hits_with_time_generation>
    <conversion_rate>30.38%</conversion_rate>
    <bounce_rate>52%</bounce_rate>
    <nb_actions_per_visit>2.9</nb_actions_per_visit>
    [...]
```

 
## Changelog

* 0.1.0 - Initial release

## Support

Please direct any feedback to the [Issue tracker on Github.](https://github.com/piwik/plugin-ApiGetWithSitesInfo/issues)