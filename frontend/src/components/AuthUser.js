import { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

function AuthUser() {
    const getToken = () => {
        const sessionData = sessionStorage.getItem('token');
        const data = JSON.parse(sessionData);
        return data;
    }
    const getUser = () => {
        const sessionData = sessionStorage.getItem('username');
        const data = JSON.parse(sessionData);
        return data;
    }

    const navigate = useNavigate();
    const [username, setUsername] = useState(getUser());
    const [token, setToken] = useState(getToken());

    const saveToken = (username, token) => {
        sessionStorage.setItem('username', JSON.stringify(username));
        sessionStorage.setItem('token', JSON.stringify(token));

        setUsername(username);
        setToken(token);
        navigate('/');
    }

    const logout = () => {
        sessionStorage.clear();
        navigate('/');
    }

    const http = axios.create({
        baseURL: 'http://127.0.0.1:8000/api/v1/',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        }
    });

    return {
        getToken,
        logout,
        setToken:saveToken,
        http,
        token, username
    }
}

export default AuthUser