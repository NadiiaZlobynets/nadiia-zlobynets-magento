/**
 * Magento/luma - en_US
 * grunt exec:luma && grunt less:luma
 * grunt exec:luma && grunt less:luma && grunt watch
 *
 * DVCampus/luma - uk_UA
 * grunt exec:nadiiaz_luma_uk_ua && grunt less:nadiiaz_luma_uk_ua
 * grunt exec:nadiiaz_luma_uk_ua && grunt less:nadiiaz_luma_uk_ua && grunt watch:nadiiaz_luma_uk_ua
 */
module.exports = {
    nadiiaz_luma_uk_ua: {
        area: 'frontend',
        name: 'Nadiiaz/luma',
        locale: 'uk_UA',
        files: [
            'css/styles-m',
            'css/styles-l'
        ],
        dsl: 'less'
    }
};
