module.exports = {
  content: ["./**/*.php", "./src/**/*.js", "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      dropShadow: {
        "ca-text": "0 1 1 rgba(0,0,0, 0.7)"
      },
      scale: {
        md: "1.07",
        lg: "1.15"
      },
      colors: {
        primaryBlue: "#009999",
        primarySoft: "#00b5b5",
        primaryHard: "#007a7a",
        secondaryColor: "#FFA500",
        secondarySoft: "#fbae20",
        secondaryHard: "#e29200",
        limeGreen: "#a5cf7b",
        textColor: "rgb(71 85 105)"
      },
      fontFamily: {
        sans: ["Roboto", "sans-serif"],
        osw: ["Oswald", "sans-serif"]
      }
    }
  },
  plugins: [require("@tailwindcss/typography"), require("flowbite/plugin")]
};
