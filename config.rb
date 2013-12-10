set :site_title, "YANA"
set :site_url, "http://localhost" # TODO

set :css_dir, 'stylesheets'
set :js_dir, 'javascripts'
set :images_dir, 'images'

helpers do
  def video_embed(url)
    video = VideoInfo.get(url)
    video.embed_code
  end

  def absolute_url(resource)
    return '' unless resource
    u = URI.join(config[:site_url], resource.url)
    u.to_s
  end
end

activate :autoprefixer do |config|
  config.browsers = ['> 1%', 'last 2 versions', 'ie 7', 'ie 8', 'ie 9', 'ff 17', 'opera 12.1']
end

# Build-specific configuration
configure :build do
  activate :minify_css
  activate :minify_javascript
  activate :asset_hash
end

activate :deploy do |deploy|
  deploy.build_before = true
  deploy.method = :rsync
  deploy.host   = "dialect.ca"
  deploy.path   = "/home/dialect/yana.dialect.ca"
  deploy.user  = "dialect"
  deploy.clean = true
end
