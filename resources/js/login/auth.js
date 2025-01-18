import axios from "axios";

class Auth {
    constructor() {
        // Retrieve token from localStorage
        this.token = window.localStorage.getItem("token");

        // Safely retrieve and parse user data from localStorage
        let userData = window.localStorage.getItem("user");
        try {
            this.user = userData ? JSON.parse(userData) : null;
        } catch (error) {
            console.error("Invalid user data in localStorage:", error);
            this.user = null; // Reset user if parsing fails
        }

        // Set default Authorization header if token exists
        if (this.token) {
            axios.defaults.headers.common["Authorization"] = this.token;
        }
    }

    /**
     * Login method to store token and user data in localStorage
     * @param {string} token - The user's authentication token
     * @param {object} user - The user's data object
     */
    login(token, user) {
        try {
            // Validate the user object before saving
            if (!user || typeof user !== "object" || !user.id) {
                throw new Error("Invalid user object. Must be a valid JSON object with an 'id' field.");
            }

            // Save token and user data in localStorage
            const bearerToken = "Bearer " + token;
            window.localStorage.setItem("token", bearerToken);
            window.localStorage.setItem("user", JSON.stringify(user));

            // Set axios Authorization header
            axios.defaults.headers.common["Authorization"] = bearerToken;

            // Update instance variables
            this.token = bearerToken;
            this.user = user;

            console.log("User logged in successfully.");
        } catch (error) {
            console.error("Failed to login:", error);
        }
    }

    /**
     * Checks if the user is authenticated
     * @returns {boolean} - True if token exists, false otherwise
     */
    check() {
        return !!this.token;
    }

    /**
     * Logout method to clear token and user data
     */
    logout() {
        try {
            // Remove token and user data from localStorage
            window.localStorage.removeItem("token");
            window.localStorage.removeItem("user");

            // Clear instance variables
            this.token = null;
            this.user = null;

            // Clear axios Authorization header
            delete axios.defaults.headers.common["Authorization"];

            console.log("User logged out successfully.");
        } catch (error) {
            console.error("Failed to logout:", error);
        }
    }
}

export default new Auth();
