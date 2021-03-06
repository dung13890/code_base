var plugins = {
  bower: [
    {
      in: 'bootstrap/dist',
      out: 'bootstrap'
    },
    {
      in: 'jquery/dist',
      out: 'jquery'
    },
    {
      in: 'components-font-awesome/css',
      out: 'font-awesome/css'
    },
    {
      in: 'components-font-awesome/fonts',
      out: 'font-awesome/fonts'
    },
    {
      in: 'datatables.net/js',
      out: 'datatables/js'
    },
    {
      in: 'datatables.net-bs/css',
      out: 'datatables-bs/css'
    },
    {
      in: 'datatables.net-bs/js',
      out: 'datatables-bs/js'
    },
    {
      in: 'summernote/dist',
      out: 'summernote'
    }
  ],
  sass: [
    {
      in: 'backend/app.scss',
      out: 'backend/app.css'
    },
    {
      in: 'frontend/app.scss',
      out: 'frontend/app.css'
    }
  ]
}
module.exports = plugins;
