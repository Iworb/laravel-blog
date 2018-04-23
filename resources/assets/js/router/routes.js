const routes = [
  {
    path: '/',
    component: resolve => {
      require.ensure(['../layouts/default'], () => {
        resolve(require('../layouts/default'))
      }, 'js/layouts/default')
    },
    children: [
      {
        path: '',
        component: resolve => {
          require.ensure(['../pages/home'], () => {
            resolve(require('../pages/home'))
          }, 'js/pages/home')
        }
      }
    ]
  }
]

export default routes
