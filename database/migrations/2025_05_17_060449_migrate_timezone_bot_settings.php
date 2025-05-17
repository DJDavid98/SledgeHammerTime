<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    $etcGmtPositiveDoubleDigit = '"Etc(?:\\/|/)GMT\+(\d{2})"';
    $etcGmtPositiveSingleDigit = '"Etc(?:\\/|/)GMT\+(\d)"';
    $etcGmtNegativeDoubleDigit = '"Etc(?:\\/|/)GMT-(\d{2})"';
    $etcGmtNegativeSingleDigit = '"Etc(?:\\/|/)GMT-(\d)"';
    DB::statement(<<<SQL
      UPDATE settings SET value = regexp_replace(replace(value::text, '\/', '/'), '^$etcGmtPositiveDoubleDigit$', 'GMT-\1:00')::json
      WHERE setting = 'timezone' AND value::text ~ '^$etcGmtPositiveDoubleDigit$'
      SQL
    );
    DB::statement(<<<SQL
      UPDATE settings SET value = regexp_replace(replace(value::text, '\/', '/'), '^$etcGmtPositiveSingleDigit$', 'GMT-0\1:00')::json
      WHERE setting = 'timezone' AND value::text ~ '^$etcGmtPositiveSingleDigit$'
      SQL
    );
    DB::statement(<<<SQL
      UPDATE settings SET value = regexp_replace(replace(value::text, '\/', '/'), '^$etcGmtNegativeDoubleDigit$', 'GMT+\1:00')::json
      WHERE setting = 'timezone' AND value::text ~ '^$etcGmtNegativeDoubleDigit$'
      SQL
    );
    DB::statement(<<<SQL
      UPDATE settings SET value = regexp_replace(replace(value::text, '\/', '/'), '^$etcGmtNegativeSingleDigit$', 'GMT+0\1:00')::json
      WHERE setting = 'timezone' AND value::text ~ '^$etcGmtNegativeSingleDigit$'
      SQL
    );
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    DB::statement(<<<'SQL'
      UPDATE settings SET value = regexp_replace(replace(value::text, '\/', '/'), '^"GMT-0(\d):00"$', '"Etc/GMT+0\1:00')::json
      WHERE setting = 'timezone' AND value::text ~ '^"-0\d:00"$'
      SQL
    );
    DB::statement(<<<'SQL'
      UPDATE settings SET value = regexp_replace(replace(value::text, '\/', '/'), '^"GMT-(\d{2}):00"$', '"Etc/GMT+\1:00')::json
      WHERE setting = 'timezone' AND value::text ~ '^"-\d{2}:00"$'
      SQL
    );
    DB::statement(<<<'SQL'
      UPDATE settings SET value = regexp_replace(replace(value::text, '\/', '/'), '^"GMT\+0(\d):00"$', '"Etc/GMT-0\1')::json
      WHERE setting = 'timezone' AND value::text ~ '^"\+0\d:00"$'
      SQL
    );
    DB::statement(<<<'SQL'
      UPDATE settings SET value = regexp_replace(replace(value::text, '\/', '/'), '^"GMT\+(\d{2}):00"$', '"Etc/GMT-\1')::json
      WHERE setting = 'timezone' AND value::text ~ '^"\+\d{2}:00"$'
      SQL
    );
    DB::statement(<<<'SQL'
      DELETE FROM settings
      WHERE setting = 'timezone' AND value::text ~ '^"GMT[+-]\d{2}:\d{2}"$'
      SQL
    );
  }
};
