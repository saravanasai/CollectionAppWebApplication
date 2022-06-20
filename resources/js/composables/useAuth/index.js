
import api from "../../config"
export default function useAuth()
{

     function setAuthToken(token,user={})
     {
         window.localStorage.setItem('auth_token',token)
         window.localStorage.setItem('user',JSON.stringify(user))
     }

     function getUserInfo()
     {
         return window.localStorage.getItem('user')
     }

     function isAuthenticated()
     {
         return window.localStorage.getItem('auth_token') ? true : false;

     }

     function removeAuthToken()
     {
         window.localStorage.removeItem('auth_token')
         window.localStorage.removeItem('user')
     }

     function registeration(data)
     {
        return api.post('user-registeration',data)
     }

     function login(data)
     {
        return api.post('login',data)
     }


     function logout()
     {
        return api.post('logout')
     }

     return {registeration,login,setAuthToken,logout,removeAuthToken,isAuthenticated,getUserInfo}
}
