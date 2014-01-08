# EBANX Payment Gateway PrestaShop Extension

This plugin allows you to integrate your PrestaShop store with the EBANX payment gateway.
It includes support to installments and custom interest rates.

## Installation
1. Clone the git repo to your PrestaShop root folder
```
git clone --recursive https://github.com/ebanx/ebanx-prestashop.git
```
2. Go to your shop administation area, then to **Modules > Modules**.
3. Find the EBANX module name and click the **Install** button next to it.
4. Enter the integration key you were given by the EBANX integration team. You will need to use different keys in test and production modes.
5. Change the other settings if needed.
6. Click the _Save_ button on the right corner of the screen.
7. Go to the EBANX Merchant Area, then to **Integration > Merchant Options**.
  1. Change the _Status Change Notification URL_ to:
  ```
  {YOUR_SITE}/index.php?fc=module&module=ebanx&controller=notify
  ```
  2. Change the _Response URL_ to:
  ```
  {YOUR_SITE}/index.php?fc=module&module=ebanx&controller=return
  ```
8. That's all!

## Changelog
1.0.0: first release