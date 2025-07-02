<?php

declare(strict_types = 1);

namespace AvtoDev\Composer\Cleanup;

class Rules
{
    /**
     * Get global packages cleanup rules.
     *
     * Values can contains asterisk (`*` - zero or more characters) and question mark (`?` - exactly one character).
     *
     * @see <https://www.php.net/manual/en/function.glob.php#refsect1-function.glob-parameters>
     *
     * @return array<string>
     */
    public static function getGlobalRules(): array
    {
        return [
            '*.md', '*.MD', '*.rst', '*.RST', '*.markdown',
            // Markdown/reStructuredText files like `README.md`, `changelog.MD`..
            'AUTHORS', 'LICENSE', 'COPYING', 'AUTHORS', // Text files without extensions
            'CHANGES.txt', 'CHANGES', 'CHANGELOG.txt', 'LICENSE.txt', 'TODO.txt', 'README.txt', // Text files
            '.github', '.gitlab', // .git* specific directories
            '.gitignore', '.gitattributes', // git-specific files
            'phpunit.xml*', 'phpstan.neon*', 'phpbench.*', 'psalm.*', '.psalm', // Test configurations
            '.travis.yml', '.travis', '.scrutinizer.yml', '.circleci', 'appveyor.yml', // CI
            '.codecov.yml', '.coveralls.yml', '.styleci.yml', '.dependabot', // CI
            '.php_cs', '.php_cs.*', 'phpcs.*', '.*lint', // Code-style definitions
            '.gush.yml', 'bors.toml', '.pullapprove.yml', // 3rd party integrations
            '.editorconfig', '.idea', '.vscode', // Configuration for editors
            'phive.xml', 'build.xml', // Build configurations
            'composer.lock', // Composer lock file
            'Makefile', // Scripts, Makefile
            'Dockerfile', 'docker-compose.yml', 'docker-compose.yaml', '.dockerignore', // Docker
        ];
    }

    /**
     * Get packages cleanup rules as array, where key is package name, and value is an array of directories and/or
     * file names, which must be deleted.
     *
     * Values can contains asterisk (`*` - zero or more characters) and question mark (`?` - exactly one character).
     *
     * @see <https://www.php.net/manual/en/function.glob.php#refsect1-function.glob-parameters>
     *
     * @return array<string, array<string>>
     */
    public static function getPackageRules(): array
    {
        return [
            'dnoegel/php-xdg-base-dir'         => ['tests'],
            'lcobucci/jwt'                     => ['test'],
            'monolog/monolog'                  => ['tests'],
            'morrislaptop/laravel-queue-clear' => ['tests'],
            'myclabs/deep-copy'                => ['doc'],
            'nikic/php-parser'                 => ['test', 'test_old', 'doc'],
            'phpstan/phpdoc-parser'            => ['doc'],
            'rap2hpoutre/laravel-log-viewer'   => ['tests'],
            'schuppo/password-strength'        => ['tests'],
            'spatie/laravel-permission'        => ['art', 'docs'],
            'symfony/css-selector'             => ['Tests'],
            'symfony/debug'                    => ['Tests'],
            'symfony/event-dispatcher'         => ['Tests'],
            'symfony/filesystem'               => ['Tests'],
            'symfony/finder'                   => ['Tests'],
            'symfony/http-foundation'          => ['Tests'],
            'symfony/http-kernel'              => ['Tests'],
            'symfony/options-resolver'         => ['Tests'],
            'symfony/routing'                  => ['Tests'],
            'symfony/stopwatch'                => ['Tests'],

            'artesaos/seotools'                     => ['tests'],
            'cakephp/chronos'                       => ['docs'],
            'deployer/deployer'                     => ['docs'],
            'deployer/recipes'                      => ['docs'],
            'google/apiclient'                      => ['docs'],
            'hackzilla/password-generator'          => ['Tests'],
            'phenx/php-font-lib'                    => ['tests'],
            'predis/predis'                         => ['examples'],
            'rmccue/requests'                       => ['tests', 'docs', 'examples'],
            'stil/gd-text'                          => ['examples', 'tests'],
            'theiconic/php-ga-measurement-protocol' => ['tests', 'docs'],
            'zircote/swagger-php'                   => ['tests', 'examples', 'docs'],

            'chumper/zipper'               => ['tests'],
            'cogpowered/finediff'          => ['tests'],
            'elasticsearch/elasticsearch'  => ['tests', 'travis', 'docs'],
            'meyfa/php-svg'                => ['tests'],
            'ralouphie/getallheaders'      => ['tests'],
            'react/promise'                => ['tests'],
            'sabberworm/php-css-parser'    => ['tests'],
            'unisharp/laravel-filemanager' => \array_merge(self::getLaravelFileManagerRules(), ['tests', 'docs']),
            'yoomoney/yookassa-sdk-php'    => ['tests', '*.md'],

            'binarytorch/larecipe'                  => ['package*', '*.js', 'yarn.lock'],
            'clue/stream-filter'                    => ['tests', 'examples'],
            'dragonmantank/cron-expression'         => ['tests'],
            'erusev/parsedown-extra'                => ['test'],
            'friendsofphp/php-cs-fixer'             => ['*.sh', 'doc'], // Note: `tests` must be not included
            'fakerphp/faker'                        => \array_merge(self::getFakerPhpRules(), ['test']),
            'hamcrest/hamcrest-php'                 => ['tests'],
            'jakub-onderka/php-console-color'       => ['tests'],
            'jakub-onderka/php-console-highlighter' => ['tests', 'examples'],
            'johnkary/phpunit-speedtrap'            => ['tests'],
            'justinrainbow/json-schema'             => ['demo'],
            'kevinrob/guzzle-cache-middleware'      => ['tests'],
            'mockery/mockery'                       => ['tests', 'docker', 'docs'],
            'mtdowling/jmespath.php'                => ['tests'],
            'nesbot/carbon'                         => self::getNesbotCarbonRules(),
            'paragonie/random_compat'               => ['other', '*.sh'],
            'paragonie/sodium_compat'               => ['*.sh', 'plasm-*.*', 'dist'],
            'phar-io/manifest'                      => ['tests', 'examples'],
            'phar-io/version'                       => ['tests'],
            'phpunit/php-code-coverage'             => ['tests'],
            'phpunit/php-file-iterator'             => ['tests'],
            'phpunit/php-timer'                     => ['tests'],
            'phpunit/php-token-stream'              => ['tests'],
            'phpunit/phpunit'                       => ['tests'],
            'psy/psysh'                             => ['.phan', 'test', 'vendor-bin'],
            'queue-interop/amqp-interop'            => ['tests'],
            'queue-interop/queue-interop'           => ['tests'],
            'sebastian/code-unit-reverse-lookup'    => ['tests'],
            'sebastian/comparator'                  => ['tests'],
            'sebastian/diff'                        => ['tests'],
            'sebastian/environment'                 => ['tests'],
            'sebastian/exporter'                    => ['tests'],
            'sebastian/object-enumerator'           => ['tests'],
            'sebastian/object-reflector'            => ['tests'],
            'sebastian/recursion-context'           => ['tests'],
            'sebastian/resource-operations'         => ['tests', 'build'],
            'sentry/sentry-laravel'                 => ['test', 'scripts', '.craft.yml'],
            'spiral/goridge'                        => ['examples', '*.go', 'go.mod', 'go.sum'],
            'spiral/roadrunner'                     => [
                'cmd', 'osutil', 'service', 'util', 'systemd', '*.mod', '*.sum', '*.go', '*.sh', 'tests',
            ],
            'swiftmailer/swiftmailer'               => ['tests', 'doc'],
            'symfony/psr-http-message-bridge'       => ['Tests'],
            'symfony/service-contracts'             => ['Test'],
            'symfony/translation'                   => ['Tests'],
            'symfony/translation-contracts'         => ['Test'],
            'symfony/var-dumper'                    => ['Tests', 'Test'],
            'theseer/tokenizer'                     => ['tests'],

            'sebastian/type'            => ['tests'],
            'sebastian/global-state'    => ['tests'],
            'sebastian/code-unit'       => ['tests'],
            'phpunit/php-invoker'       => ['tests'],
            'facade/ignition-contracts' => ['Tests', 'docs'],
            'doctrine/annotations'      => ['docs'],
            'doctrine/inflector'        => ['docs'],
            'doctrine/instantiator'     => ['docs'],

            'voku/portable-ascii'            => ['docs'],
            'anhskohbo/no-captcha'           => ['tests'],
            'beyondcode/laravel-dump-server' => ['docs'],
            'dompdf/dompdf'                  => ['LICENSE.LGPL'],
            'kalnoy/nestedset'               => ['tests'],
            'phenx/php-svg-lib'              => ['tests', 'COPYING.GPL'],
            'wapmorgan/morphos'              => ['tests', '*.md'],
            'proj4php/proj4php'              => ['test'],
            'aws/aws-sdk-php'                => ['.changes', '.github'],
            'afiqiqmal/huawei-push'                   => ['tests'],
            'symfony/console'                         => ['Tester'],
            'phpunit/phpunit-selenium'                => ['Tests', 'selenium-1-tests'],
            'opekunov/laravel-centrifugo-broadcaster' => ['tests'],
            'laravel/ui'                              => ['tests'],
            'maennchen/zipstream-php'                 => ['test'],
            'markbaker/matrix'                        => ['examples'],
            'markbaker/complex'                       => ['examples'],
            'cbschuld/browser.php'                    => ['tests'],
            'maxmind-db/reader'                       => ['ext/tests', 'examples', 'tests'],
            'kwn/number-to-words'                     => ['tests'],
            'tecnickcom/tcpdf'                        => ['doc', 'examples', '*.TXT'],
            'kigkonsult/icalcreator'                  => ['docs'],
            'pear/archive_tar'                        => ['docs', 'tests', 'sync-php4'],
            'pear/cache_lite'                         => ['docs', 'tests', 'TODO'],
            'pear/console_getopt'                     => ['Console/tests'],
            'pear/mime_type'                          => ['docs', 'tests'],
            'pear/structures_graph'                   => ['docs', 'tests'],
            'psr/log'                                 => ['Psr/Log/Test'],
        ];
    }

    /**
     * Package fzaninotto/faker moved to fakerphp/faker.
     *
     * @return array<string>
     */
    protected static function getFakerPhpRules(): array
    {
        return \array_map(static function (string $locale): string {
            return "src/Faker/Provider/{$locale}";
        }, [
            'el_GR', 'en_SG', 'fa_IR', 'ja_JP', 'mn_MN', 'pl_PL', 'vi_VN', 'zh_CN', 'sk_SK',
            'ar_JO', 'en_AU', 'en_UG', 'fi_FI', 'hu_HU', 'ka_GE', 'ms_MY', 'pt_BR', 'sr_RS',
            'ar_SA', 'cs_CZ', 'en_CA', 'hy_AM', 'kk_KZ', 'nb_NO', 'pt_PT', 'sv_SE', 'zh_TW',
            'at_AT', 'da_DK', 'en_ZA', 'fr_BE', 'id_ID', 'ko_KR', 'ne_NP', 'ro_MD', 'tr_TR',
            'en_HK', 'es_AR', 'fr_CA', 'nl_BE', 'ro_RO', 'th_TH', 'fr_CH', 'lt_LT', 'nl_NL',
            'de_AT', 'en_IN', 'es_ES', 'es_PE', 'fr_FR', 'is_IS', 'lv_LV', 'de_CH', 'en_NG',
            'bg_BG', 'de_DE', 'en_NZ', 'es_VE', 'he_IL', 'it_CH', 'me_ME', 'sl_SI', 'bn_BD',
            'el_CY', 'en_PH', 'et_EE', 'hr_HR', 'it_IT', 'uk_UA', 'sr_Cyrl_RS', 'sr_Latn_RS',
        ]);
    }

    /**
     * @return array<string>
     */
    protected static function getNesbotCarbonRules(): array
    {
        // Define the locales you want to KEEP
        $localesToKeep = [
            'ar',
            'fr',
            'en',
        ];

        // Get a list of all possible locale files (assuming a common pattern like 'xx.php' or 'xx_YY.php')
        // This is a more robust way than hardcoding every single locale to remove.
        // In a real scenario, you might dynamically get this list from the Carbon package itself
        // or from the file system, but for this example, we'll simulate it.
        // For simplicity, let's assume we want to remove everything that's not explicitly kept.

        // A simple approach is to define a wildcard that matches all lang files,
        // and then exclude the ones you want to keep.
        // The `composer-cleanup-plugin` uses glob patterns.

        // We want to remove all files in src/Carbon/Lang/ that are NOT ar.php, fr.php, or en.php.
        // Since the plugin's logic is about defining what to REMOVE,
        // we need to specify patterns for all other files.

        // This is how you'd specify rules to remove *everything*
        // and then you'd need a way to *exclude* certain files,
        // but the plugin's direct API for `getNesbotCarbonRules` is about *including* what to remove.

        // Let's re-think based on how the plugin expects rules:
        // It takes an array of glob patterns for files to be removed.
        // So we need to generate patterns for all locales *except* ar, fr, and en.

        // This approach might be more complex than simply listing what to remove.
        // The original code uses a comprehensive list of patterns to remove.
        // The most straightforward way to achieve your goal with the current plugin's design
        // is to generate a list of all *other* possible locale patterns and then remove them.

        // Given the plugin's current implementation, it's easier to list what to remove.
        // We'll generate patterns for all possible single and double character locales,
        // and then filter out 'ar', 'fr', and 'en'.

        $localesToRemove = [];

        // Generate patterns for all 2-letter locales (e.g., 'aa', 'ab', ..., 'zz')
        for ($i = ord('a'); $i <= ord('z'); $i++) {
            for ($j = ord('a'); $j <= ord('z'); $j++) {
                $locale = chr($i) . chr($j);
                if (!\in_array($locale, $localesToKeep, true)) {
                    $localesToRemove[] = $locale;
                    $localesToRemove[] = "{$locale}_*"; // Also remove any regional variations like en_GB
                }
            }
        }

        // Add patterns for single-letter and three-letter locales if they exist and are not 'ar', 'fr', 'en'
        // This part is less precise because Carbon primarily uses 2-letter base locales.
        // The original code has 'a?', 'a??' etc., which are broad.
        // Let's stick to generating patterns for specific exclusions rather than broad inclusions for removal.

        // A simpler and more direct approach for your specific request:
        // Assume we want to remove ALL language files that are not 'ar', 'fr', or 'en'.
        // The most reliable way is to match all locale files and then implicitly keep the desired ones
        // by NOT including their patterns in the removal list.

        // The current implementation is designed to explicitly list what to remove.
        // So, we need to list all language files *except* ar.php, fr.php, and en.php.
        // The broadest pattern that matches all locale files is "src/Carbon/Lang/*.php".
        // Since the plugin doesn't have an "exclude" mechanism within a rule set,
        // we have to be more specific with the "include for removal" patterns.

        // Let's create a comprehensive list of all potential 2-letter locales and their variations
        // and then filter out the ones we want to keep. This is safer than wildcards that might
        // accidentally remove 'en', 'ar', or 'fr'.

        $allPossibleLocalePrefixes = [];
        foreach (range('a', 'z') as $char1) {
            foreach (range('a', 'z') as $char2) {
                $allPossibleLocalePrefixes[] = $char1 . $char2;
            }
        }

        $removalPatterns = [];
        foreach ($allPossibleLocalePrefixes as $prefix) {
            if (!\in_array($prefix, $localesToKeep, true)) {
                // Pattern for base locale file (e.g., 'de.php')
                $removalPatterns[] = "src/Carbon/Lang/{$prefix}.php";
                // Pattern for regional variations (e.g., 'de_DE.php')
                $removalPatterns[] = "src/Carbon/Lang/{$prefix}_*.php";
            }
        }

        // If there are single-letter or three-letter locales that are not 'en', 'ar', 'fr',
        // you would need to add patterns for them too.
        // Based on Carbon's structure, most are 2-letter or 2-letter_XX.

        // The original function's `a?`, `a??` patterns are very broad.
        // To be precise and only remove what you don't need while keeping 'ar', 'fr', 'en',
        // the above approach (generating all possible 2-letter prefixes and filtering) is robust.

        // Let's try to replicate the spirit of the original by listing patterns to remove,
        // but ensuring 'ar', 'fr', 'en' are explicitly *not* matched.

        // The simplest way to achieve this using the given function signature and how the plugin works:
        // Iterate through all possible language file names you want to *remove*.
        // Since we know the ones to keep, we generate patterns for everything else.

        $rules = [];

        // Loop through all possible starting letters
        for ($i = ord('a'); $i <= ord('z'); $i++) {
            $char1 = chr($i);
            // Loop through all possible second letters (for 2-letter codes)
            for ($j = ord('a'); $j <= ord('z'); $j++) {
                $char2 = chr($j);
                $locale = $char1 . $char2;

                // If the locale is NOT one of the ones we want to keep, add patterns to remove it
                if (!\in_array($locale, $localesToKeep, true)) {
                    $rules[] = "src/Carbon/Lang/{$locale}.php";    // e.g., src/Carbon/Lang/de.php
                    $rules[] = "src/Carbon/Lang/{$locale}_*.php"; // e.g., src/Carbon/Lang/de_DE.php
                }
            }
        }

        // Consider any other specific patterns that might exist but are not 'ar', 'fr', 'en'
        // For instance, if Carbon had 'aaa.php' and you didn't want it, you'd add:
        // if (!\in_array('aaa', $localesToKeep, true)) { $rules[] = "src/Carbon/Lang/aaa.php"; }

        // If there are single character locales (e.g., 'a.php'), you'd need to add them.
        // Carbon's locales are mostly 2-letter or 2-letter_REGION.

        // This function assumes the format "src/Carbon/Lang/{locale}.php".
        // The key is to generate all possible locale names *except* ar, fr, and en.

        // The most reliable way to achieve this without over-complicating with broad wildcards
        // that might accidentally match 'en', 'ar', 'fr' (e.g., if you used `e?*` and it matched `en`):

        // Start with a very broad pattern that catches everything, then remove the exceptions.
        // However, the current plugin's structure makes it define what to remove directly.

        // So, the final simple and effective solution:
        // Generate rules for all 2-letter combinations (and their _* variations)
        // and explicitly skip 'ar', 'fr', 'en'.

        $removeRules = [];

        // Loop through all possible 2-character locale codes
        foreach (range('a', 'z') as $char1) {
            foreach (range('a', 'z') as $char2) {
                $locale = $char1 . $char2;
                if ($locale !== 'ar' && $locale !== 'fr' && $locale !== 'en') {
                    $removeRules[] = "src/Carbon/Lang/{$locale}.php";
                    $removeRules[] = "src/Carbon/Lang/{$locale}_*.php";
                }
            }
        }

        // Add any other specific patterns that are NOT ar, fr, en that might exist (e.g., if there's a 'foo.php'
        // that you don't want, and it's not covered by the 2-char logic).
        // Based on the original code, some broad patterns were used (e.g., 'e[bel]_*').
        // To ensure 'en' is kept, we must be careful with 'e*' patterns.

        // The safest is to be explicit about what you remove based on common Carbon locale naming.
        // The 2-character + optional _* pattern covers most Carbon locales.

        return $removeRules;
    }


    /**
     * @return string[]
     */
    protected static function getLaravelFileManagerRules(): array
    {
        return \array_map(static function (string $locale): string {
            return "src/lang/{$locale}";
        }, [
            'ar', 'az', 'bg', 'de', 'el', 'eu', 'fa', 'fr', 'he', 'hu', 'id', 'it', 'ka', 'nl', 'pl', 'pt', 'pt-BR',
            'ro', 'rs', 'sv', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW',
        ]);
    }
}
