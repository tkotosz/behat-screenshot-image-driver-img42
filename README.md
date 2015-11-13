ImageDriver-Img42 for Behat-ScreenshotExtension
=========================
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tkotosz/behat-screenshot-image-driver-img42/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tkotosz/behat-screenshot-image-driver-img42/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/tkotosz/behat-screenshot-image-driver-img42/badges/build.png?b=master)](https://scrutinizer-ci.com/g/tkotosz/behat-screenshot-image-driver-img42/build-status/master)
[![Build Status](https://travis-ci.org/tkotosz/behat-screenshot-image-driver-img42.svg?branch=master)](https://travis-ci.org/tkotosz/behat-screenshot-image-driver-img42)

This package is an image driver for the [bex/behat-screenshot](https://github.com/elvetemedve/behat-screenshot) behat extension which can upload the screenshot to [Img42](http://img42.com) and print the url of the uploaded image.

Installation
------------

Install by adding to your `composer.json`:

```bash
composer require --dev bex/behat-screenshot-image-driver-img42
```

Configuration
-------------

Enable the image driver in the Behat-ScreenshotExtension's config in `behat.yml` like this:

```yml
default:
  extensions:
    Bex\Behat\ScreenshotExtension:
      active_image_drivers: img42
```

The uploaded image will live for 10 minutes.

Usage
-----

When you run behat and a step fails then the Behat-ScreenshotExtension will automatically take the screenshot and will pass it to the image driver, which will upload it and returns the URL of the uploaded image. So you will see something like this:

```bash
  Scenario:                           # features/feature.feature:2
    Given I have a step               # FeatureContext::passingStep()
    When I have a failing step        # FeatureContext::failingStep()
      Error (Exception)
Screenshot has been taken. Open image at https://img42.com/idoftheimage
    Then I should have a skipped step # FeatureContext::skippedStep()
```