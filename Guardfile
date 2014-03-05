guard :jammit, config_path: 'assets.yml', output_folder: '.' do
  watch(%r{^(www/wp-content/themes/yana/js/.*)\.js$})
end

guard 'sass', input: 'www/wp-content/themes/yana/css', output: 'www/wp-content/themes/yana', style: :compressed, smart_partials: true
guard 'coffeescript', input: 'www/wp-content/themes/yana/js'
