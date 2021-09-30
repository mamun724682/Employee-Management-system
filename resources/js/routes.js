import employeesIndex from './components/employees/index'
import employeesCreate from './components/employees/create'
import employeesEdit from './components/employees/edit'

export const routes = [
    {
        path: '/employees',
        name: "employeesIndex",
        component: employeesIndex
    },
    {
        path: '/employees/create',
        name: "employeesCreate",
        component: employeesCreate
    },
    {
        path: '/employees/:id',
        name: "employeesEdit",
        component: employeesEdit
    }
]
